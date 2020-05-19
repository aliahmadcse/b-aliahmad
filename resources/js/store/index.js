import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        projects: [
            {
                title: "Nadias Graden Restaurant"
            },
            {
                title:'Hotel Reservation App'
            }
        ]
    },
    mutations: {
        SET_PROJECTS(state, projects) {
            state.projects = projects;
        }
    },
    actions: {}
});
