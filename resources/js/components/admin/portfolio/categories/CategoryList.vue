<template>
    <div>
        <router-link
            class="btn btn-outline-secondary mb-3 ml-3"
            :to="{name:'project.categories.add'}"
        >Add New Catgeory</router-link>
        <table class="table table-striped table-responsive table-project-list">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td scope="row">web</td>
                    <td scope="row">
                        <router-link
                            class="btn btn-outline-secondary"
                            :to="{name:'project.categories.view'}"
                        >View</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
</style>