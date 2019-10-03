<template>
    <div>

        <vue-message v-if="message.show" :message="message"></vue-message>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-xs-12 col-lg-6">
                                <i class="fa fa-align-justify"></i> <strong>{{ object.title }}</strong>
                            </div>
                            <div class="col-xs-12 col-lg-6">
                                <div class="btn-group-right">
                                    <router-link v-if="this.object.create" :to="{ name: pageName + '_store'}" tag="a"
                                                 class="btn btn-success btn-sm">
                                        Create new
                                    </router-link>
                                    <a v-if="this.object.delete" @click.prevent="deleteItems()" href="#" :class="[selected.length ? 'btn btn-danger btn-sm' : 'btn btn-secondary btn-sm']">
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="!loading" class="card-block">
                        <div v-if="entityData">

                            <forrm v-if="object.search" @submit.prevent="onSearch">
                                <div class="row">
                                    <div class="col-xs-12 col-md-6 col-lg-4">
                                        <div class="input-group">
                                            <input v-model="selection.query"
                                                   type="text"
                                                   class="form-control"
                                                   placeholder="Enter value">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-primary" @click.prevent="onSearch">
                                                    Search
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </forrm>

                            <br>

                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th>
                                        <a href="#" @click.prevent="selectAll()">
                                            Select
                                        </a>
                                    </th>
                                    <th v-for="column in object.columns" v-if="column.table == true">
                                        <a v-if="selection.query == null || selection.query == ''"
                                           href="#"
                                           @click.prevent="setOrder(column.field)">
                                            {{ column.title }}
                                        </a>
                                        <a v-else="" href="#">
                                            {{ column.title }}
                                        </a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody v-for="item in entityData.data">
                                <vue-list-row :item="item" :object="object" :checkedAll="checkedAll"></vue-list-row>
                                </tbody>
                            </table>

                            <vue-pagination :data="entityData"
                                            v-on:pagination-change-page="setPage"></vue-pagination>

                        </div>
                        <div v-else>
                            Sorry, no items :(
                        </div>
                    </div>
                    <div v-else class="card-block">
                        <div class="sk-three-bounce">
                            <div class="sk-child sk-bounce1"></div>
                            <div class="sk-child sk-bounce2"></div>
                            <div class="sk-child sk-bounce3"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                entityData: {},
                pageName: null,
                object: {},
                selection: {
                    query: null,
                    page: 1,
                    orders: null,
                },
                selected: [],
                errors: [],
                loading: true,
                message: {
                    show: false,
                    text: false,
                    type: false
                },
                checkedAll: false,
                search: null
            }
        },
        created: function () {
            this.getPageName();
        },
        mounted: function () {
            console.log('Admin list page mounted.');
            this.object = this.$store.state[this.pageName];
            this.getData();
            let orders = _.filter(this.object.columns, function (column) {
                return column.table === true;
            });
            this.selection.orders = _.cloneDeep(orders);
        },
        computed: {
            model: function () {
                let list = [];
                this.object.columns.forEach(function (column) {
                    list[column.field] = null
                });
                return list;
            }
        },
        watch: {
            selection: {
                handler: function () {
                    this.getData();
                },
                deep: true
            }
        },
        methods: {
            getData: function () {
                let self = this;
                console.log('Get data');
                axios.post('/admin/' + self.pageName, self.selection)
                    .then(function (response) {
                        self.entityData = response.data.items;
                        self.errors = [];
                        self.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                        self.loading = false;
                    });
            },
            getPageName: function () {
                let path = this.$route.path;
                let pathArray = path.split('/');
                this.pageName = (pathArray[0] !== '') ? pathArray[0] : pathArray[1]; // @TODO: remove this hack
            },
            setPage: function (page) {
                this.selection.page = page;
            },
            setOrder: function (field) {
                let self = this;
                let selected;
                for (let i = 0; i < self.selection.orders.length; i++) {
                    if (self.selection.orders[i].field === field) {
                        if (self.selection.orders[i].order === 'ASC') {
                            self.selection.orders[i].order = 'DESC';
                        } else {
                            self.selection.orders[i].order = 'ASC';
                        }
                        selected = self.selection.orders[i];
                        self.selection.orders.splice(i, 1);
                    }
                }

                self.selection.orders.unshift(selected);
            },
            deleteItems: function () {
                let self = this;
                if (self.selected.length) {
                    let ids = [];
                    for (let i = 0; i < self.selected.length; i++) {
                        ids.push(self.selected[i].id);
                    }
                    ids = {
                        ids :ids.toString()
                    };
                    axios.post('/admin/' + self.pageName + '/destroyList', ids)
                        .then(function (response) {
                            console.log('Delete items');
                            self.errors = [];
                            self.selected = [];
                            self.loading = false;
                            self.getData();
                            self.showMessage('success', self.object.title_single + ' items delete successfully');
                        })
                        .catch(function (error) {
                            console.log(error);
                            self.loading = false;
                        });
                } else {
                    self.showMessage('warning', 'Select ' + self.object.title_single + ' items to delete');
                }
            },
            showMessage: function (type, text) {
                let self = this;
                self.message.show = true;
                self.message.type = type;
                self.message.text = text;
                setTimeout(function () {
                    self.message.show = false;
                    self.message.type = false;
                    self.message.text = false;
                }, 3000);
            },
            selectAll: function () {
                this.checkedAll = !(this.checkedAll);
            },
            onSearch: function () {
                console.log(this.search)
            }
        }
    }
</script>