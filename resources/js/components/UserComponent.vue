<template>
    <div class="container">
        <h2>Groups</h2>
        <input @keyup="searchGroup()" type="text" class="form-control" name="search" v-model="search">

        <div class="card card-body" v-for="group in groups" v-bind:key="group.id">
            <p> {{group.group_name}} </p>
        </div>
    </div>
</template>

<script>

    export default {

        data() {
            return {
                search: '',
                groups: [],
                group: {
                    id: '',
                    group_name: ''
                }
            }
        },

        created() {
            this.searchGroup();
            
        },

            methods: {

                searchGroup() {
                    fetch('group/search?q='+this.search).then(res => res.json()).then(res => {
                        this.groups = res;
                    }).catch(err => {
                        console.log(err);
                    })
                }
            }
    }

</script>
