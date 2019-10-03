<template>
    <div>

        <div v-if="column.type === 'file'">
            <a v-if="item[column.field]" :href="item[column.field]" target="_blank" class="fileLink">
                <i class="icon-docs icons font-2xl d-block mt-4"></i>
            </a>
            <span v-else>-</span>
        </div>

        <div v-else-if="column.type === 'image'">
            <img width="100" v-bind:src="image(column.type)" :alt="column.title">
        </div>

        <div v-else-if="column.type === 'belongsTo'">
            {{ getRelationValue(item, column) }}
        </div>

        <div v-else-if="column.type === 'color'">
            <div class="colorPreview" v-bind:style="{ background: item[column.field] }"></div>
        </div>

        <div v-else-if="column.type === 'icon'">
            <i class="fa" v-bind:class="item[column.field]" aria-hidden="true"></i>
        </div>

        <div v-else-if="column.type === 'title'">
            <p v-if="!item.deleted_at">
                <router-link :to="{ name: this.object.route + '_edit', params: { id: item.id }}" tag="a">
                    {{ item[column.field] }} <i class="fa fa-edit"></i>
                </router-link>
            </p>
            <span v-else-if="item.deleted_at">
                {{ item[column.field] }}
            </span>
        </div>

        <div v-else-if="column.type === 'date'">
            <div v-if="typeof(item.publish) !== 'undefined'">
                <p class="status" v-if="item.publish && !item.deleted_at"><span class="badge badge-success">Published</span></p>
                <p class="status" v-else-if="!item.publish"><span class="badge badge-default">Not published</span></p>
                <p class="status" v-else-if="item.deleted_at"><span class="badge badge-danger">Deleted</span></p>
            </div>
            <p class="date">
                {{ item[column.field] }}
            </p>
        </div>

        <div v-else-if="column.type === 'checkbox'">
            <div>
                {{ item[column.field] ? '+' : '-' }}
            </div>
        </div>

        <div v-else>
            <div v-if="column.is_link">
                <p v-if="!item.deleted_at">
                    <router-link :to="{ name: this.object.route + '_edit', params: { id: item.id }}" tag="a">
                        {{ item[column.field] }} <i class="fa fa-edit"></i>
                    </router-link>
                </p>
                <span v-else-if="item.deleted_at">
                    {{ item[column.field] }}
                </span>
            </div>
            <div v-else v-html="item[column.field]">

            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['item', 'object', 'column', 'columns'],
        methods: {
            getRelationValue: function (item, column) {
                let fieldName = column.relation_field,
                    relationObj = item[column.relation_obj];
                if (column.relation_label) {
                    return relationObj ? relationObj[fieldName] + ' (' + relationObj[column.relation_label] + ')' : '-';
                }
                return relationObj ? relationObj[fieldName] : '-';
            }
        }
    }
</script>

<style>
    .colorPreview {
        width: 20px;
        height: 20px;
        border-radius: 50%;
    }
    .badge {
        padding: 0.4em !important;
        margin-bottom: 5px;
    }
    .fileLink {
        text-decoration: none !important;
    }
</style>