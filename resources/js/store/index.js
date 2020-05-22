import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        projectCategories: []
    },

    mutations: {
        SET_PROJECT_CATEGORIES(state, categories) {
            state.projectCategories = categories;
        }
    },

    getters: {
        projects: state => {
            let projects = [];
            // pushing all projects into new projects array
            state.projectCategories.forEach(projectCategory => {
                projects.push(...projectCategory.projects);
            });
            // Here, we use lodash orderBy methods to sort projects array by display_order
            return _.orderBy(projects, ["display_order"], ["asc"]);
        },

        webProjects: state => {
            let webProjects = [];
            state.projectCategories.forEach(projectCategory => {
                projectCategory.category == "web"
                    ? webProjects.push(...projectCategory.projects)
                    : "";
            });
            return webProjects;
        },

        mlProjects: state => {
            let mlProjects = [];
            state.projectCategories.forEach(projectCategory => {
                projectCategory.category == "ml"
                    ? mlProjects.push(...projectCategory.projects)
                    : "";
            });
            return mlProjects;
        }
    },
    actions: {}
});
