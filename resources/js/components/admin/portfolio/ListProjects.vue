<template>
    <div>
        <router-link
            class="btn btn-outline-secondary mb-3 ml-3"
            :to="{name:'project.add'}"
        >Add Project</router-link>
        <table class="table table-striped table-responsive table-project-list">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Github</th>
                    <th scope="col" colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td scope="row">Nadias Graden Restaurant</td>
                    <td scope="row">Web</td>
                    <td scope="row">https://github.com/aliahmadcse/nadias-garden</td>
                    <td scope="row">
                        <router-link
                            class="btn btn-outline-secondary"
                            :to="{name:'project.view'}"
                        >View</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    methods: {}
};
</script>

<style lang="scss" scoped>
</style>