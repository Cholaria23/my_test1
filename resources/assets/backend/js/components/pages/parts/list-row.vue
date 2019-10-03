<template>
    <tr v-bind:class="{ 'deleted': item.deleted_at }">

        <td style="width:65px; text-align: center;">
            <input type="checkbox"
                   @click="toggleSelected"
                   :checked="checked"
                   :value="item.id"
                   :id="item.id"
                   class="checkbox">
        </td>

        <td v-for="column in object.columns" v-if="column.table == true" :class="[column.type]">
            <vue-list-col :item="item" :object="object" :column="column" :columns="columns"></vue-list-col>
        </td>

    </tr>
</template>

<script>
    export default {
        props: ['item', 'object', 'checkedAll'],
        data: function () {
            return {
                menu: false,
                showTrash: false
            }
        },
        watch: {
            checkedAll: {
                handler: function () {
                    this.toggleSelected();
                },
                deep: true
            }
        },
        computed: {
            checked: function () {
                for (let i = 0; i < this.$parent.selected.length; i++) {
                    if (this.$parent.selected[i].id === this.item.id) {
                        return true;
                    }
                }
                return false;
            }
        },
        methods: {
            image: function (type) {
                return this.item['original_' + type + '_url'];
            },
            toggleSelected: function () {
                if (this.checked) {
                    for (let i = 0; i < this.$parent.selected.length; i++) {
                        if (this.$parent.selected[i].id === this.item.id) {
                            this.$parent.selected.splice(i, 1);
                        }
                    }
                } else {
                    this.$parent.selected.push(this.item);
                }
            }
        }
    }
</script>