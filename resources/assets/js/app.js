
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

Vue.mixin({
    methods: {
        setView: function(view) {
            this.$store.commit('setView', view);
            this.$emit('view');
        }
    }
});

Vue.component('album-index', require('./components/album/Index.vue'));
Vue.component('album-show', require('./components/album/Show.vue'));
Vue.component('bar-player', require('./components/BarPlayer.vue'));
Vue.component('home', require('./components/Home.vue'));

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

/**
 * Load the store first so the app has data to fetch.
 */
const store = new Vuex.Store({
    state: {
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

const app = new Vue({
    el: '#app',
    store,
    data: {
        currentView: store.state.view,
    },
    methods: {
        setView: function() {
            this.currentView = store.state.view;
        }
    }
});



// const player = new Vue({
//     el: '#barplayer'
// });
