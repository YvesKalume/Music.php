export default {
    add: ids => {
        if (ids.lastIndexOf(',') === ids.length - 1) ids = ids.substring(0, ids.length - 1);
        let array = ids.split(',');
        array.forEach(id => {
            this.queue.push(id);
        });
        if ($('#player')[0].paused) {
            this.playFromQueue();
        }
    },
    audio: null,
    getAudio: function(id) {
        $.get({
            url: document.location.origin + "/tracks/" + id,
            success: data => {
                // $('#source').attr('src', document.location.origin + "/tracks/" + id + "/audio");
                let artists = "";
                $.each(data.artists, index => {
                    artists += `${data.artists[index].name} `;
                });
                this.status.setData(data);
                $("#icon").attr("class", "glyphicon glyphicon-pause");
                this.audio = new Audio('/tracks/' + id + '/audio');
                this.audio.addEventListener('timeupdate', event => this.status.setDuration(event));
                this.audio.addEventListener('ended', () => this.next());
                this.audio.volume = this.volume.get();
                this.audio.play();
                // $('#audio')[0].load();
                // $('#audio')[0].play();
            }
        });
    },
    getIcon: function() {
        if (!this.status.getStatus() || this.audio.paused) {
            return "glyphicon-play";
        }
        return "glyphicon-pause";
    },
    getPercent: function() {
        let data = this.status.getData();
        return data.currentTime / data.duration * 100;
    },
    next: function() {
        console.log("Now moving to next track...");
        this.audio.pause();
        // delete(this.audio);
        this.audio = null;
        this.queue.splice(0, 1);
        if (!this.queue[0]) {
            $("#icon").attr("class", "glyphicon glyphicon-play");
            this.status.resetData();
            console.log(this.status.getData().durationString);
            return;
        }
        this.getAudio(this.queue[0].id);
    },
    parseTime: function(time, recur) {
        time = Math.floor(time);
        let timeString = "";
        timeString = time % 60 < 10 ? "0" + time % 60 + timeString : time % 60 + timeString;
        if (time / 60 < 1 && !recur) return "0:" + timeString;
        if (time / 60 < 1) return timeString;
        return this.parseTime(time / 60, true) + ":" + timeString;
    },
    play: function(track) {
        if (this.audio) {
            this.audio.pause();
            // delete(this.audio);
            this.audio = null;
        }
        this.queue.splice(0, 1, track);
        this.status.setStatus(true);
        this.getAudio(track.id);
    },
    push: function(tracks) {
        for (let i = 0; i < tracks.length; i++) {
            this.queue.push(tracks[i]);
        }
        if (!this.status.getStatus()) {
            this.status.setStatus(true);
            this.getAudio(this.queue[0].id);
        }
    },
    queue: [],
    status: {
        properties: {
            data: {
                artists: "-",
                currentTime: 0,
                duration: 0,
                durationString: "-:--/-:--",
                percent: 0,
                title: "No track playing"
            },
            change: false,
            playing: false
        },
        getData() {
            return this.properties.data;
        },
        getDurationString() {
            return this.properties.data.durationString;
        },
        setDurationString: () => {
            this.a.status.properties.data.durationString = this.a.parseTime(this.a.status.getData().currentTime) + "/" + this.a.parseTime(this.a.status.getData().duration);
        },
        getStatus() {
            return this.properties.playing;
        },
        resetData() {
            this.properties.data = {
                artists: "-",
                currentTime: 0,
                duration: 0,
                durationString: "-:--/-:--",
                percent: 0,
                title: "No track playing"
            };
            this.properties.playing = false;
        },
        setData(data) {
            this.properties.data.title = data.title;
            let artists = "";
            $.each(data.artists, index => {
                artists += `${data.artists[index].name} `;
            });
            this.properties.data.artists = artists;
        },
        setDuration: function(event) {
            /**
             * This makes sure that the player is actually running before setting
             * status. This is important, because otherwise the player will set a
             * random time string even though nothing is playing.
             */
            if (!this.getStatus()) return;

            this.properties.data.currentTime = event.target.currentTime;
            this.properties.data.duration = event.target.duration;
            this.properties.data.percent = event.target.currentTime / event.target.duration * 100;
            this.setDurationString();
        },
        setStatus(status) {
            this.properties.playing = status;
        }
    },
    toggle: function() {
        if (!this.status.getStatus()) {
            console.log("Player is not active. Ignoring play request...");
            return;
        }
        if (this.audio.paused) {
            return this.audio.play();
        }
        this.audio.pause();
    },
    volume: {
        value: 1,
        get: function() {
            return this.value;
        },
        set: value => {
            if (this.a.audio) {
                this.a.audio.volume = value;
            }
            this.a.volume.value = value;
        }
    }
};
