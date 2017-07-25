
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(Vuex);

Vue.component('album-display', require('./components/album/Display.vue'));
Vue.component('album-index', require('./components/album/Index.vue'));
Vue.component('album-show', require('./components/album/Show.vue'));
Vue.component('file-handler', require('./components/FileHandler.vue'));
Vue.component('bar-player', require('./components/BarPlayer.vue'));
Vue.component('column', require('./components/Column.vue'));
Vue.component('home', require('./components/Home.vue'));
Vue.component('queue', require('./components/Queue.vue'));
Vue.component('track-index', require('./components/track/Index.vue'));
Vue.component('track-info', require('./components/player/TrackInfo.vue'));
Vue.component('track-span', require('./components/player/TrackSpan.vue'));
Vue.component('track-upload', require('./components/TrackUploadPanel.vue'));

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

Vue.component('text-input', require('./components/form/TextInput.vue'));
Vue.component('password-input', require('./components/form/PasswordInput.vue'));
Vue.component('select-input', require('./components/form/SelectInput.vue'));
Vue.component('submit-button', require('./components/form/SubmitButton.vue'));

/**
 * Load the store first so the app has data to fetch.
 */
const store = new Vuex.Store({
    state: {
        admin: false,
        album: null,
        view: "home"
    },
    getters: {
        currentAlbum: state => state.album
    },
    mutations: {
        setAlbum: (state, data) => state.album = data,
        setView: (state, data) => state.view = data
    }
});

Vue.mixin({
    methods: {
        cancel: function(e) {
            console.log("Cancelling default submit behavior");
            e.preventDefault();
        },
        checkAdmin: function() {
            return this.$store.state.admin;
        },
        getView: function() {
            return this.$store.state.view;
        },
        setView: function(view) {
            this.$store.commit('setView', view);
            if (arguments.length > 1) {
                for (let i = 1; i < arguments.length; i++) {
                    this.$store.commit(arguments[i][0], arguments[i][1]);
                }
            }
        }
    }
});

const app = new Vue({
    el: '#app',
    store,
    data: {
        admin: store.state.admin,
        currentView: store.state.view,
    },
    methods: {
        getView: function() {
            this.currentView = store.state.view;
            return store.state.view;
        },
        toggleAdmin: function() {
            store.state.admin = !store.state.admin;
            this.admin = store.state.admin;
        }
    }
});
