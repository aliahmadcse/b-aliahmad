import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        projectCategories: [],
        projects: [],
        // blogs are the paginated blogs returned from server
        blogs: {},
        // blogPosts are the unpaginated blogs
        blogPosts: [],
        // blog is a single piece of blog returned by id
        blog: {},
        // tagBlogs are the blogs specific to a single tag used on front end
        tagBlogs: {},
        // blogTags are the blog tags returned from the server
        blogTags: []
    },

    mutations: {
        // blog
        SET_BLOG(state, blog) {
            state.blog = blog;
        },

        // blogPosts
        SET_BLOG_POSTS(state, blogPosts) {
            state.blogPosts = blogPosts;
        },

        ADD_BLOG_POST(state, blogPost) {
            // adding a blog post at the beginning of array
            state.blogPosts.unshift(blogPost);
        },

        UPDATE_BLOG_POSTS(state, blogPost) {
            state.blogPosts = state.blogPosts.map(blog => {
                if (blog.id == blogPost.id) {
                    return blogPost;
                }
                return blog;
            });
        },

        REMOVE_BLOG_POST(state, id) {
            state.blogPosts = state.blogPosts.filter(post => post.id != id);
        },

        // blog tags
        SET_BLOG_TAGS(state, blogTags) {
            state.blogTags = blogTags;
        },

        ADD_BLOG_TAG(state, tag) {
            state.blogTags.push(tag);
        },

        UPDATE_BLOG_TAG(state, { id, tag }) {
            state.blogTags = state.blogTags.map(blogTag => {
                if (blogTag.id == id) {
                    blogTag["tag"] = tag;
                    return blogTag;
                }
                return blogTag;
            });
        },

        REMOVE_BLOG_TAG(state, id) {
            state.blogTags = state.blogTags.filter(tag => tag.id != id);
        },

        // blogs

        SET_BLOGS(state, blogs) {
            state.blogs = blogs;
        },

        SET_TAG_BLOGS(state, tagBlogs) {
            state.tagBlogs = tagBlogs;
        },

        //projects

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

        ADD_PROJECT(state, project) {
            state.projects.push(project);
        },

        // project categories
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
        blogTagById: state => id => {
            return state.blogTags.filter(tag => tag.id == id);
        },

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

            return projects.length > 0 ? projects : getters.allProjects;
        }
    },

    actions: {
        getProjects({ commit, state }) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/projects")
                    .then(res => {
                        commit("SET_PROJECTS", res.data);
                        resolve("Success");
                    })
                    .catch(err => {
                        console.log(err);
                        reject("Failed");
                    });
            });
        },

        // getting blog tags from server
        getBlogTags({ commit, state }) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/blog/tags")
                    .then(res => {
                        commit("SET_BLOG_TAGS", res.data);
                        resolve("Success");
                    })
                    .catch(err => {
                        console.log(err);
                        reject("Failed");
                    });
            });
        },

        getBlog({ commit, state }, blogId) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/blog/" + blogId)
                    .then(res => {
                        commit("SET_BLOG", res.data);
                        resolve("Success");
                    })
                    .catch(err => {
                        console.log(err);
                        reject("Failed");
                    });
            });
        }
    }
});
