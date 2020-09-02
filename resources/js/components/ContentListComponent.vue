<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Title</th>
                        <th>Last Updated</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(content, index) in contents" :key="index">
                        <td>{{ content.order_no }}</td>
                        <td v-html="content.title"></td>
                        <td>
                            {{ lastUpdated(content.updated_at) }}
                        </td>
                        <td>
                            <a :href="getContentPageRoute(content.id)" class="btn btn-primary">View</a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        name: "ContentListComponent",

        data() {
            return {
                contents: [],
            };
        },

        mounted() {
            this.getContentList();
        },

        methods: {
            getContentList() {
                axios.get("/api/contents").then(response => {
                    this.contents = response.data;
                }).catch(({ error }) => {
                    alert("Something went wrong. Please try later");
                });
            },

            lastUpdated(date) {
                return moment(date).format("MMM D YYYY, h:mm a");
            },

            getContentPageRoute(id) {
                return "/admin/contents/" + id;
            },
        },
    }
</script>

<style scoped>

</style>
