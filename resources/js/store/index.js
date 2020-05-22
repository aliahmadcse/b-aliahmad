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
        categories: state => {
            // here, I use object destructuring to unpack category
            //  property from object
            return state.projectCategories.map(({ category }) => category);
        },

        allProjects: state => {
            let projects = [];
            // pushing all projects into new projects array
            state.projectCategories.forEach(projectCategory => {
                projects.push(...projectCategory.projects);
            });
            // Here, we use lodash orderBy methods to sort projects array by display_order
            return _.orderBy(projects, ["display_order"], ["asc"]);
        },

        projectsByCategory: (state, getters) => category => {
            let projects = [];
            state.projectCategories.forEach(projectCategory => {
                projectCategory.category == category
                    ? projects.push(...projectCategory.projects)
                    : "";
            });
            // return projects;
            if (projects.length > 0) {
                return projects;
            } else {
                return getters.allProjects;
            }
            // return projects ? projects.length > 0 : getters.projects;
        }
    },
    actions: {}
});
