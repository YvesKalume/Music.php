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
    getAudio: function(id) {
        $.get({
            url: document.location.origin + "/tracks/" + id,
            success: data => {
                $('#source').attr('src', document.location.origin + "/tracks/" + id + "/audio");
                let artists = "";
                $.each(data.artists, index => {
                    artists += `${data.artists[index].name} `;
                });
                this.status.setData(data);
                $("#icon").attr("class", "glyphicon glyphicon-pause");
                $('#audio')[0].load();
                $('#audio')[0].play();
            }
        });
    },
    getPercent: function() {
        let data = this.status.getData();
        return data.currentTime / data.duration * 100;
    },
    next: function() {
        $('#audio')[0].pause();
        this.queue.splice(0, 1);
        this.playFromQueue();
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
        this.queue.splice(0, 0, track);
        this.getAudio(track.id);
    },
    push: tracks => {
        for (let i = 0; i < tracks.length; i++) {
            queue.push(tracks);
        }
        if (!this.playing) {
            getAudio(this.queue[0].id);
        }
    },
    playFromQueue: function() {
        if (!this.queue[0]) {
            $("#icon").attr("class", "glyphicon glyphicon-play");
            this.status.resetData();
            $('#duration').html("-:--/-:--");
            $('#progressbar > div').width('0%');
            return;
        }
        this.play(this.queue[0].id);
    },
    playing: false,
    queue: [],
    status: {
        properties: {
            data: {
                artists: "-",
                currentTime: 0,
                duration: 0,
                title: "No track playing"
            },
            playing: false
        },
        getData() {
            return this.properties.data;
        },
        getStatus() {
            return this.properties.playing;
        },
        resetData() {
            this.properties.data.title = "No track playing";
            this.properties.data.artists = "-";
            this.properties.data.currentTime = 0;
            this.properties.data.duration = 0;
        },
        setData(data) {
            this.properties.data.title = data.title;
            let artists = "";
            $.each(data.artists, index => {
                artists += `${data.artists[index].name} `;
            });
            this.properties.data.artists = artists;
        },
        setStatus(status) {
            this.properties.playing = status;
        }
    },
    toggle: () => {
        if ($('#audio')[0].paused) {
            $("#icon").attr("class", "glyphicon glyphicon-pause");
            return $('#audio')[0].play();
        }
        $("#icon").attr("class", "glyphicon glyphicon-play");
        $('#audio')[0].pause();
    }
};
