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
        },

        ADD_PROJECT_CATEGORY(state, category) {
            state.projectCategories.push(category);
        }
    },

    getters: {
        categories: state => {
            return _.cloneDeep(state.projectCategories).map(projectCategory => {
                delete projectCategory.projects;
                return projectCategory;
            });
        },

        categoryById: state => id => {
            return state.projectCategories.filter(
                category => category.id == id
            );
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
