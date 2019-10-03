<template>

    <nav>
        <ul class="pagination" v-if="data.total > data.per_page">

            <li v-if="data.prev_page_url">
                <a @click.prevent="selectPage(--data.current_page)">
                    Prev
                </a>
            </li>

            <li v-if="data.current_page > 3">
                <a @click.prevent="selectPage(1)">
                    1
                </a>
            </li>

            <li v-if="data.current_page > 4">
                <span>
                    ...
                </span>
            </li>

            <li v-for="n in getPages()"
                v-if="n >= data.current_page - 2 && n <= data.current_page + 2"
                :class="[(n == data.current_page) ? 'active' : '']">
                <span v-if="n == data.current_page">
                    {{ n }}
                </span>
                <a v-else @click.prevent="selectPage(n)">
                    {{ n }}
                </a>
            </li>

            <li v-if="data.current_page < (Math.ceil(data.total / data.per_page) - 3)">
                <span>
                    ...
                </span>
            </li>

            <li v-if="data.current_page < (data.total / data.per_page - 2)">
                <a @click.prevent="selectPage(Math.ceil(data.total / data.per_page))">
                    {{ Math.ceil(data.total / data.per_page) }}
                </a>
            </li>

            <li v-if="data.next_page_url">
                <a @click.prevent="selectPage(++data.current_page)">
                    Next
                </a>
            </li>

        </ul>
    </nav>
</template>
<script>
    export default {
        props: {
            data: {
                type: Object,
                default: function () {
                    return {
                        current_page: 1,
                        data: [],
                        from: 1,
                        last_page: 1,
                        next_page_url: null,
                        per_page: 10,
                        prev_page_url: null,
                        to: 1,
                        total: 0,
                    }
                }
            },
            limit: {
                type: Number,
                default: 0
            }
        },
        methods: {
            selectPage: function (page) {
                this.$emit('pagination-change-page', page);
            },
            getPages: function () {
                if (this.limit === -1) {
                    return 0;
                }
                if (this.limit === 0) {
                    return this.data.last_page;
                }
                let start = this.data.current_page - this.limit,
                    end = this.data.current_page + this.limit + 1,
                    pages = [],
                    index;
                start = start < 1 ? 1 : start;
                end = end >= this.data.last_page ? this.data.last_page + 1 : end;
                for (index = start; index < end; index++) {
                    pages.push(index);
                }
                return pages;
            }
        }
    }
</script>