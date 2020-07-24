<template>
    <div class="row justify-content-center">
    <div class="col-md-8 col-md-offset-2">
        <div class="no-projects" v-if="projects">

            <div class="row">
                <div class="col-sm-12">
                    <h2 class="d-inline project-title">Projecten</h2>
                    <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#projectCreate">Nieuw project</button>
                </div>
            </div>

            <hr>

            <div v-if="projects.length > 0">
                <div class="card" v-for="project in projects" :key="project.id">
                    <div class="card-header">
                        <h4 class="d-inline">{{ project.name }}</h4>
                        <button class="btn btn-success btn-sm float-right mt-3 mb-2" :disabled="counter.timer" data-toggle="modal" data-target="#timerCreate" @click="selectedProject = project">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <ul class="list-group" v-if="project.timers && project.timers.length > 0">
                            <li v-for="timer in project.timers" :key="timer.id" class="list-group-item clearfix">
                                <strong class="timer-name">{{ timer.name }}</strong>

                                <div class="float-right">
                                    <span v-if="showTimerForProject(project, timer)" style="margin-right: 10px">
                                        <strong>{{ activeTimerString }}</strong>
                                    </span>
                                    <span v-else style="margin-right: 10px">
                                        <strong>{{ calculateTimeSpent(timer) }}</strong>
                                    </span>

                                    <button v-if="showTimerForProject(project, timer)" class="btn btn-sm btn-danger" @click="stopTimer()">
                                        <i class="fas fa-stop"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>
                        <p v-else>Er is nog niks bijgehouden voor "{{ project.name }}". Klik op het '+' icoon om te starten.</p>
                    </div>
                </div>

                <!-- Create Timer Modal -->
                <div class="modal fade" id="timerCreate" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Record tijd</h4>
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input v-model="newTimerName" type="text" class="form-control" id="usrname" placeholder="Waarvoor ben je aan het werk?">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button data-dismiss="modal" v-bind:disabled="newTimerName === ''" @click="createTimer(selectedProject)" type="submit" class="btn btn-default btn-primary"><i class="fas fa-plus"></i> Start</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-else>
                <h3 align="center">Je moet een nieuw project aanmaken</h3>
            </div>

            <!-- Create Project Modal -->
            <div class="modal fade" id="projectCreate" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nieuw project</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="newProjectName" type="text" class="form-control" id="usrname" placeholder="Project naam">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" v-bind:disabled="newProjectName === ''" @click="createProject" type="submit" class="btn btn-default btn-primary">Aanmaken</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="timers" v-else>
            Laden...
        </div>
    </div>
    </div>
</template>

<style>
    .project-title {
        margin: 0;
    }
    .panel-heading > h4 {
        margin:0;
        position: relative;
        top: 6px;
    }
</style>


<script>
    import moment from 'moment'
    export default {
        data() {
            return {
                projects: null,
                newTimerName: '',
                newProjectName: '',
                activeTimerString: 'Berekenen...',
                counter: { seconds: 0, timer: null},
            }
        },
        methods: {
            /**
             * Conditionally pads a number with "0"
             */
            _padNumber: number =>  (number > 9 || number === 0) ? number : "0" + number,
            /**
             * Splits seconds into hours, minutes, and seconds.
             */
            _readableTimeFromSeconds: function(seconds) {
                const hours = 3600 > seconds ? 0 : parseInt(seconds / 3600, 10)
                return {
                    hours: this._padNumber(hours),
                    seconds: this._padNumber(seconds % 60),
                    minutes: this._padNumber(parseInt(seconds / 60, 10) % 60),
                }
            },
            /**
             * Calculate the amount of time spent on the project using the timer object.
             */
            calculateTimeSpent: function (timer) {
                if (timer.stopped_at) {
                    const started = moment(timer.created_at)
                    const stopped = moment(timer.stopped_at)

                    const time = this._readableTimeFromSeconds(
                        parseInt(moment.duration(stopped.diff(started)).asSeconds())
                    )
                    return `${time.hours} Uur | ${time.minutes} minuten | ${time.seconds} seconden`
                }
                return ''
            },
            /**
             * Determines if there is an active timer and whether it belongs to the project
             * passed into the function.
             */
            showTimerForProject: function (project, timer) {
                return this.counter.timer &&
                       this.counter.timer.id === timer.id

            },
            /**
             * Start counting the timer. Tick tock.
             */
            startTimer: function (project, timer) {
                let vm = this
                let started = moment(timer.started_at)
                vm.counter.timer = timer
                vm.counter.timer.project = project
                vm.counter.seconds = parseInt(moment.duration(moment().diff(started)).asSeconds())
                vm.counter.ticker = setInterval(() => {
                    const time = vm._readableTimeFromSeconds(++vm.counter.seconds)
                    vm.activeTimerString = `${time.hours} Uur | ${time.minutes}:${time.seconds}`
                }, 1000)
            },
            /**
             * Stop the timer from the API and then from the local counter.
             */
            stopTimer: function () {
                window.axios.post(`/projects/${this.counter.timer.id}/timers/stop`)
                    .then(response => {
                        // Loop through the projects and get the right project...
                        this.projects.forEach(project => {
                            if (project.id) {
                                // Loop through the timers of the project and set the `stopped_at` time
                                return project.timers.forEach(timer => {
                                    if (timer.id === parseInt(this.counter.timer.id)) {
                                        return timer.stopped_at = response.data.stopped_at
                                    }
                                })
                            }
                        });
                        // Stop the ticker
                        clearInterval(this.counter.ticker)
                        // Reset the counter and timer string
                        this.counter = { seconds: 0, timer: null }
                        this.activeTimerString = 'Berekenen...'
                    })
            },
            /**
             * Create a new timer.
             */
            createTimer: function (project) {
                window.axios.post(`/projects/${project.id}/timers`, {name: this.newTimerName})
                    .then(response => {
                        project.timers.push(response.data)
                        this.startTimer(response.data.project, response.data)
                    })
                this.newTimerName = ''
            },
            /**
             * Create a new project.
             */
            createProject: function () {
                window.axios.post('/projects', {name: this.newProjectName})
                    .then(response => this.projects.push(response.data))
                this.newProjectName = ''
            }
        },
        created() {
            window.axios.get('/projects').then(response => {
                this.projects = response.data
                window.axios.get('/projects/timers/active').then(response => {
                    if (response.data.id !== undefined) {
                        this.startTimer(response.data.project, response.data)
                    }
                })
            })
        },
    }
</script>
