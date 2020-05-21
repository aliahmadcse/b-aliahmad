<template>
    <div>Project Fields</div>
</template>

<script>
export default {
    mounted: function() {
        const eleArr = document.querySelectorAll(".nav-link");
        eleArr.forEach(ele => {
            ele.classList.contains("router-link-active")
                ? ele.classList.add("active")
                : "";
        });
    }
};
</script>

<style lang="scss" scoped>
</style>