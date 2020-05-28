import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        projectCategories: [],
        projects: []
    },

    mutations: {
        SET_PROJECTS(state, projects) {
            state.projects = projects;
        },
        
        /**
         * This mutation removes the project a specific entry from
         * projects array
         * @param {object} state the state object
         * @param {integer} id the id of the project to be removed
         */
        REMOVE_PROJECT(state, id) {
            state.projects = state.projects.filter(proj => proj.id !== id);
        },

        SET_PROJECT_CATEGORIES(state, categories) {
            state.projectCategories = categories;
        },

        ADD_PROJECT_CATEGORY(state, category) {
            state.projectCategories.push(category);
        },

        REMOVE_PROJECT_CATEGORY(state, id) {
            state.projectCategories = state.projectCategories.filter(
                category => category.id !== id
            );
        },

        UPDATE_PROJECT_CATEGORY(state, { id, category }) {
            state.projectCategories = state.projectCategories.map(
                projectCategory => {
                    if (projectCategory.id == id) {
                        projectCategory["category"] = category;
                        return projectCategory;
                    }
                    return projectCategory;
                }
            );
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

        /**
         * return a project based on id
         * @param {int} id id of project
         * @returns {array} an array consisiting of single project object
         */
        projectById: state => id => {
            return state.projects.filter(project => project.id == id);
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

    actions: {
        getProjects({ commit, state }) {
            axios
                .get("/api/projects")
                .then(res => {
                    commit("SET_PROJECTS", res.data);
                })
                .catch(err => {
                    console.log(err);
                });
        }
    }
});
