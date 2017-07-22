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
    parseTime: function(time, recur) {
        time = Math.floor(time);
        let timeString = "";
        timeString = time % 60 < 10 ? "0" + time % 60 + timeString : time % 60 + timeString;
        if (time / 60 < 1 && !recur) return "0:" + timeString;
        if (time / 60 < 1) return timeString;
        return this.parseTime(time / 60, true) + ":" + timeString;
    },
    play: id => {
        $.get({
            url: document.location.origin + "/tracks/" + id,
            success: data => {
                $('#source').attr('src', document.location.origin + "/tracks/" + id + "/audio");
                let artists = "";
                $.each(data.artists, index => {
                    artists += `${data.artists[index].name} `;
                });
                $('#tracktitle').html(data.title);
                $('#trackartist').html(artists);
                $("#icon").attr("class", "glyphicon glyphicon-pause");
                $('#audio')[0].load();
                $('#audio')[0].play();
            }
        });
    },
    playFromQueue: function() {
        if (!this.queue[0]) {
            $("#icon").attr("class", "glyphicon glyphicon-play");
            $('#tracktitle').html("No track playing");
            $('#trackartist').html("-");
            $('#duration').html("-:--/-:--");
            $('#progressbar > div').width('0%');
            return;
        }
        this.play(this.queue[0].id);
    },
    playing: false,
    queue: [],
    toggle: () => {
        if ($('#audio')[0].paused) {
            $("#icon").attr("class", "glyphicon glyphicon-pause");
            return $('#audio')[0].play();
        }
        $("#icon").attr("class", "glyphicon glyphicon-play");
        $('#audio')[0].pause();
    }
};
