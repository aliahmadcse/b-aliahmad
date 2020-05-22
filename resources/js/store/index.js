import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        projectCategories: []
    },

    mutations: {
        SET_ProjectCATEGORIES(state, categories) {
            state.projectCategories = categories;
        }
    },

    getters: {
        projects: state => {
            return state.projects;
        },
        webProjects: state => {
            return state.projects.filter(project => project.category == "web");
        },
        mlProjects: state => {
            return state.projects.filter(project => project.category == "ml");
        }
    },
    actions: {}
});
