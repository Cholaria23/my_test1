<template>
    <div>

        <div v-if="column.type === 'id' && item[column.field]"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="">
                    <label>Entity ID: <strong>{{ item[column.field] }}</strong></label>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'date'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="">
                    <label>{{ column.title }}: <strong>{{ item[column.field] }}</strong></label>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'field-date'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="">
                    <label>{{ column.title }}:</label>
                </div>
                <input v-model="editDate" type="datetime-local">
            </div>
        </div>

        <div v-else-if="column.type === 'read'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="">
                    <label>{{ column.title }}: <strong>{{ item[column.field] }}</strong></label>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'title'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="">
                    <label :for="column.title" v-html="column.title"></label>
                    <div class="tab-content">
                        <div v-for="(language, index) in languages" :key="index"
                             :class="[language == activeLanguage ? 'tab-pane active' : 'tab-pane']">
                            <input v-model.trim="item.translations[language][column.field]"
                                   type="text"
                                   :class="[errors[column.field] ? 'form-control-danger form-control form-control-lg' : 'form-control form-control-lg']"
                                   :id="column.title"
                                   :placeholder="'Enter ' + column.title">
                            <span v-if="errors[column.field]" class="help-block">
                                <span v-for="(error, index) in errors[column.field][language]" :key="index" class="errorMessage">
                                    {{ error }}
                                </span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'slug'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="input-group">
                    <label :for="column.title" class="input-group-addon">
                        {{ column.title }}
                    </label>
                    <input v-model.trim="item[column.field]"
                           type="text"
                           :class="[errors[column.field] ? 'form-control-danger form-control' : 'form-control']"
                           :id="column.title"
                           :placeholder="'Enter ' + column.title">
                </div>
                <span v-if="errors[column.field]" class="help-block">
                    <span v-for="error in errors[column.field]" class="errorMessage">
                        {{ error }}
                    </span>
                </span>
            </div>
        </div>

        <div v-else-if="column.type === 'string'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="">
                    <label :for="column.title" v-html="column.title"></label>

                    <div v-if="column.translated && column.position != 'advanced'">
                        <div class="tab-content">
                            <div v-for="language in languages"
                                 :class="[language == activeLanguage ? 'tab-pane active' : 'tab-pane']">
                                <input v-model="item.translations[language][column.field]"
                                       type="text"
                                       :class="[errors[column.field] ? 'form-control-danger form-control' : 'form-control']"
                                       :id="column.title"
                                       :placeholder="'Enter ' + column.title">
                                <span v-if="errors[column.field]" class="help-block">
                                    <span v-for="error in errors[column.field][language]" class="errorMessage">
                                        {{ error }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="column.translated && column.position == 'advanced'">
                        <div class="tab-content">
                            <div v-for="language in languages"
                                 :class="[language == activeLanguage ? 'tab-pane active' : 'tab-pane']">
                                <input v-model="item.fields[column.advanced_name].translations[language][column.field]"
                                       type="text"
                                       :class="[errors[column.field] ? 'form-control-danger form-control' : 'form-control']"
                                       :id="column.title"
                                       :placeholder="'Enter ' + column.title">
                                <span v-if="errors[column.field]" class="help-block">
                                    <span v-for="error in errors[column.field][language]" class="errorMessage">
                                        {{ error }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <input v-model="item[column.field]"
                               type="text"
                               :class="[errors[column.field] ? 'form-control-danger form-control' : 'form-control']"
                               :id="column.title"
                               :placeholder="'Enter ' + column.title">
                        <span v-if="errors[column.field]" class="help-block">
                            <span v-for="error in errors[column.field]" class="errorMessage">
                                {{ error }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'number'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="">
                    <label :for="column.title" v-html="column.title"></label>

                    <div v-if="column.position === 'advanced'">
                        <div>
                            <input v-model="item[column.advanced_name]"
                                   type="number"
                                   :class="[errors[column.field] ? 'form-control-danger form-control' : 'form-control']"
                                   :id="column.title"
                                   :placeholder="'Enter ' + column.title">
                            <span v-if="errors[column.field]" class="help-block">
                                <span v-for="error in errors[column.field]" class="errorMessage">
                                    {{ error }}
                                </span>
                            </span>
                        </div>
                    </div>
                    <div v-else>
                        <input v-model="item[column.field]"
                               type="number"
                               :class="[errors[column.field] ? 'form-control-danger form-control' : 'form-control']"
                               :id="column.title"
                               :placeholder="'Enter ' + column.title">
                        <span v-if="errors[column.field]" class="help-block">
                            <span v-for="error in errors[column.field]" class="errorMessage">
                                {{ error }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'icon'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="">
                    <label :for="column.title" v-html="column.title"></label>
                    <input v-model="item[column.field]"
                           type="text"
                           :class="[errors[column.field] ? 'form-control-danger form-control' : 'form-control']"
                           :id="column.title"
                           :placeholder="'Enter ' + column.title">
                    <span v-if="errors[column.field]" class="help-block">
                        <span v-for="error in errors[column.field]" class="errorMessage">
                            {{ error }}
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'password'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="">
                    <label :for="column.title" v-html="column.title"></label>
                    <input v-model.trim="item[column.field]"
                           type="password"
                           :class="[errors[column.field] ? 'form-control-danger form-control' : 'form-control']"
                           :id="column.title"
                           :placeholder="'Enter ' + column.title">
                    <span v-if="errors[column.field]" class="help-block">
                        <span v-for="error in errors[column.field]" class="errorMessage">
                            {{ error }}
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'checkbox'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div>
                    <label :for="column.title" v-html="column.title"></label>&#160;&#160;
                    <label class="switch switch-text switch-pill switch-success">
                        <input v-model="item[column.field]" :id="column.title" type="checkbox" class="switch-input">
                        <span data-on="On" data-off="Off" class="switch-label"></span>
                        <span class="switch-handle"></span>
                    </label>
                    <span v-if="errors[column.field]" class="help-block">
                        <span v-for="error in errors[column.field]" class="errorMessage">
                            {{ error }}
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'textarea'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="">
                    <label :for="column.title" v-html="column.title"></label>
                    <div v-if="column.translated && column.position != 'advanced'">
                        <div class="tab-content">
                            <div v-for="language in languages"
                                 :class="[language == activeLanguage ? 'tab-pane active' : 'tab-pane']">
                                <textarea v-model="item.translations[language][column.field]"
                                          :id="column.title"
                                          rows="4"
                                          :placeholder="'Enter ' + column.title"
                                          :class="[errors[column.field] ? 'form-control-danger form-control' : 'form-control']"
                                          style="margin-top: 0px; margin-bottom: 0px; height: 120px;"></textarea>
                                <span v-if="errors[column.field]" class="help-block">
                                    <span v-for="error in errors[column.field][language]" class="errorMessage">
                                        {{ error }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="column.translated && column.position == 'advanced'">
                        <div class="tab-content">
                            <div v-for="language in languages"
                                 :class="[language == activeLanguage ? 'tab-pane active' : 'tab-pane']">
                                <textarea
                                    v-model="item.fields[column.advanced_name].translations[language][column.field]"
                                    :id="column.title"
                                    rows="4"
                                    :placeholder="'Enter ' + column.title"
                                    :class="[errors[column.field] ? 'form-control-danger form-control' : 'form-control']"
                                    style="margin-top: 0px; margin-bottom: 0px; height: 120px;"></textarea>
                                <span v-if="errors[column.field]" class="help-block">
                                    <span v-for="error in errors[column.field][language]" class="errorMessage">
                                        {{ error }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <textarea v-model="item[column.field]"
                                  :id="column.title"
                                  rows="4"
                                  :placeholder="'Enter ' + column.title"
                                  :class="[errors[column.field] ? 'form-control-danger form-control' : 'form-control']"
                                  style="margin-top: 0px; margin-bottom: 0px; height: 120px;"></textarea>
                        <span v-if="errors[column.field]" class="help-block">
                            <span v-for="error in errors[column.field]" class="errorMessage">
                                {{ error }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'text'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="">
                    <label :for="column.title" v-html="column.title"></label>
                    <div v-if="column.translated && column.position !== 'advanced'">
                        <div class="tab-content">
                            <div v-for="language in languages"
                                 :class="[language === activeLanguage ? 'tab-pane active' : 'tab-pane']">
                                <quill-editor v-model="item.translations[language][column.field]"
                                              :options="editorOption"></quill-editor>
                                <span v-if="errors[column.field]" class="help-block">
                                    <span v-for="error in errors[column.field]" class="errorMessage">
                                        {{ error }}
                                    </span>
                                </span>
                                <span v-else-if="errors['content']" class="help-block">
                                    <span v-for="error in errors['content'][language]" class="errorMessage">
                                        {{ error }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div v-else-if="column.translated && column.position === 'advanced'">
                        <div class="tab-content">
                            <div v-for="language in languages"
                                 :class="[language === activeLanguage ? 'tab-pane active' : 'tab-pane']">
                                <quill-editor
                                    v-model="item.fields[column.advanced_name].translations[language][column.field]"
                                    :options="editorOption"></quill-editor>
                                <span v-if="errors[column.field]" class="help-block">
                                    <span v-for="error in errors[column.field][language]" class="errorMessage">
                                        {{ error }}
                                    </span>
                                </span>
                                <span v-else-if="errors['content']" class="help-block">
                                    <span v-for="error in errors['content'][language]" class="errorMessage">
                                        {{ error }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <quill-editor v-model="item[column.field]" :options="editorOption"></quill-editor>
                        <span v-if="errors[column.field]" class="help-block">
                            <span v-for="error in errors[column.field]" class="errorMessage">
                                {{ error }}
                            </span>
                        </span>
                        <span v-if="errors['content']" class="help-block">
                            <span v-for="error in errors['content']" class="errorMessage">
                                {{ error }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'color'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="">
                    <label :for="column.title" v-html="column.title"></label>
                    <input v-model="item[column.field]"
                           type="color"
                           :class="[errors[column.field] ? 'form-control-danger form-control' : 'form-control']"
                           :id="column.title"
                           :placeholder="'Enter ' + column.title">
                    <span v-if="errors[column.field]" class="help-block">
                        <span v-for="error in errors[column.field]" class="errorMessage">
                            {{ error }}
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'belongsTo'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="">
                    <label :for="column.title" v-html="column.title"></label>
                    <select
                        :class="[errors[column.field] ? 'form-control-danger form-control custom-select' : 'form-control custom-select']"
                        v-model="item[column.field]">
                        <option v-for="relationItem in relationItems" v-bind:value="relationItem.id">
                            {{relationItem[relationsTitle]}}
                            <template v-if="column.additional_title">
                                ({{ relationItem[column.additional_title]['title'] }})
                            </template>
                            <template v-if="column.relation_label && relationItem[column.relation_label]">
                                ({{ relationItem[column.relation_label] }})
                            </template>
                        </option>
                    </select>
                    <span v-if="errors[column.field]" class="help-block">
                        <span v-for="error in errors[column.field]" class="errorMessage">
                            {{ error }}
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'belongsToMany'">
            <div v-if="column.multiple">
                <div v-for="(relationAttrs, key) in relationItems"
                     :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
                    <div class="col-sm-12">
                        <label :for="column.title">{{ getFieldTitle(key) }}</label>
                        <select
                            :class="[errors[column.field] ? 'form-control-danger form-control custom-select' : 'form-control custom-select']"
                            v-model="multipleRelationData[key]" multiple>
                            <option v-for="relationItem in relationAttrs" v-bind:value="relationItem.id">
                                {{relationItem[relationsTitle]}}
                                <template v-if="column.relation_label && relationItem[column.relation_label]">
                                    ({{ relationItem[column.relation_label] }})
                                </template>
                            </option>
                        </select>
                        <span v-if="errors[column.field]" class="help-block">
                            <span v-for="error in errors[column.field]" class="errorMessage">
                                {{ error }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>
            <div v-else-if="column.is" :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
                <div class="col-sm-12" v-if="item[column.is]">
                    <label :for="column.title" v-html="column.title"></label>
                    <select
                        :class="[errors[column.field] ? 'form-control-danger form-control custom-select' : 'form-control custom-select']"
                        v-model="item[column.field]" multiple>
                        <option v-for="relationItem in relationItems" v-bind:value="relationItem.id">
                            {{relationItem[relationsTitle]}}
                            <template v-if="column.relation_label && relationItem[column.relation_label]">
                                ({{ relationItem[column.relation_label] }})
                            </template>
                        </option>
                    </select>
                    <span v-if="errors[column.field]" class="help-block">
                        <span v-for="error in errors[column.field]" class="errorMessage">
                            {{ error }}
                        </span>
                    </span>
                </div>
            </div>
            <div v-else="" :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
                <div class="col-sm-12">
                    <label :for="column.title" v-html="column.title"></label>
                    <select
                        :class="[errors[column.field] ? 'form-control-danger form-control custom-select' : 'form-control custom-select']"
                        v-model="item[column.field]" multiple>
                        <option v-for="relationItem in relationItems" v-bind:value="relationItem.id">
                            {{relationItem[relationsTitle]}}
                            <template v-if="column.relation_label && relationItem[column.relation_label]">
                                ({{ relationItem[column.relation_label] }})
                            </template>
                        </option>
                    </select>
                    <span v-if="errors[column.field]" class="help-block">
                        <span v-for="error in errors[column.field]" class="errorMessage">
                            {{ error }}
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'image'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <label> {{ column.title }}: </label>
                <div>
                    <div class="images-container">
                        <template v-if="item[column.field] !== null && item[column.field] !== 'null'">
                            <!--if picture exist on server - get picture by attribute original_{{picture}}_url-->
                            <div class="image-container" v-if="item[column.field].length < 50">
                                <div class="controls">
                                    <a @click.prevent="deletePhoto(column.field)" href="#" class="control-btn remove">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                                <div class="image"
                                     v-bind:style="{ backgroundImage: 'url(' + image(column.field) + ')' }">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 135 135"
                                         width="135px" height="135px">
                                        <rect width="135" height="135" fill="none"/>
                                    </svg>
                                </div>
                            </div>
                            <!--if picture was rewritten by string base64-->
                            <div class="image-container" v-else="">
                                <div class="controls">
                                    <a @click.prevent="deletePhoto(column.field)" href="#" class="control-btn remove">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </div>
                                <div class="image"
                                     v-bind:style="{ backgroundImage: 'url(' + item[column.field] + ')' }">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 135 135"
                                         width="135px" height="135px">
                                        <rect width="135" height="135" fill="none"/>
                                    </svg>
                                </div>
                            </div>
                        </template>
                        <!--if picture does not exist anywhere-->
                        <a href="#" class="add-image" @click.prevent="getPhoto(column.field)" v-else="">
                            <div class="image-container new">
                                <div class="image">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 135 135"
                                         width="135px" height="135px">
                                        <rect width="135" height="135" fill="none"/>
                                    </svg>
                                    <i class="fa fa-plus"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <input :id="column.field" style="display:none" type="file" @change="onImageChange($event)">
                <div>
                    <div v-if="errors[column.field]">
                        <span v-for="error in errors[column.field]" class="errorMessage">{{ error }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'file'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <label> {{ column.title }}: </label>
                <strong v-if="typeof (item[column.field]) === 'string'" v-html="item[column.field]"></strong>
                <input v-on:change="selectFile()"
                       type="file"
                       :class="[errors[column.field] ? 'form-control-danger form-control' : 'form-control']"
                       :id="column.title"
                       :placeholder="'Enter ' + column.title">
                <div>
                    <div v-if="errors[column.field]">
                        <span v-for="error in errors[column.field]" class="errorMessage">{{ error }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'select'"
             :class="[errors[column.field] ? 'row form-group has-danger' : 'row form-group']">
            <div class="col-sm-12">
                <div class="">
                    <label :for="column.title" v-html="column.title"></label>
                    <select
                        :class="[errors[column.field] ? 'form-control-danger form-control custom-select' : 'form-control custom-select']"
                        v-model="item[column.field]">
                        <option v-bind:value="null">-- Select --</option>
                        <option v-for="(item, index) in column.options" v-bind:value="item">
                            {{ item }}
                        </option>
                    </select>
                    <span v-if="errors[column.field]" class="help-block">
                        <span v-for="error in errors[column.field]" class="errorMessage">
                            {{ error }}
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <div v-else-if="column.type === 'morphMany' && column.position === 'gallery'">
            <div class="row">
                <div class="col-xs-4 col-md-4 col-lg-2" v-for="(picture, index) in item[column.field]" :key="index">
                    <div>
                        <div class="images-container">
                            <template
                                v-if="picture[column.relation_field] !== null && picture[column.relation_field] !== 'null'">
                                <!--if picture exist on server - get picture by attribute original_{{picture}}_url-->
                                <div class="image-container" v-if="picture[column.relation_field].length < 50">
                                    <div class="controls">
                                        <a @click.prevent="deletePhoto(index)" href="#" class="control-btn remove">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </div>
                                    <div class="image"
                                         v-bind:style="{ backgroundImage: 'url(' + image(column.relation_field, index) + ')' }">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 135 135"
                                             width="135px" height="135px">
                                            <rect width="135" height="135" fill="none"/>
                                        </svg>
                                    </div>
                                </div>
                                <!--if picture was rewritten by string base64-->
                                <div class="image-container" v-else="">
                                    <div class="controls">
                                        <a @click.prevent="deletePhoto(index)" href="#" class="control-btn remove">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </div>
                                    <div class="image"
                                         v-bind:style="{ backgroundImage: 'url(' + picture[column.relation_field] + ')' }">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 135 135"
                                             width="135px" height="135px">
                                            <rect width="135" height="135" fill="none"/>
                                        </svg>
                                    </div>
                                </div>
                            </template>
                            <!--if picture does not exist anywhere-->
                            <a href="#" class="add-image" @click.prevent="getPhoto(column.relation_field + '-' + index)"
                               v-else="">
                                <div class="image-container new">
                                    <div class="image">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 135 135"
                                             width="135px" height="135px">
                                            <rect width="135" height="135" fill="none"/>
                                        </svg>
                                        <i class="fa fa-plus"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <input :id="column.relation_field + '-' + index" style="display:none" type="file"
                           @change="onImageChange($event, index)">
                    <div>
                        <div v-if="errors[column.field]">
                            <span v-for="error in errors[column.field]" class="errorMessage">{{ error }}</span>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
    import {slugify} from 'transliteration';

    export default {
        mounted() {
            this.getRelations();
            this.$bus.$on('validationErrorsEvent', (event) => {
                this.errors = event.errors;
                setTimeout(() => {
                    this.errors = [];
                }, 7000);
            });
            if (this.column.type === 'field-date') {
                this.setDate();
            }
        },
        props: ['column', 'item', 'activeLanguage'],
        data() {
            return {
                editorOption: {
                    modules: {
                        toolbar: [
                            [{'size': ['small', false, 'large']}],
                            ['bold', 'italic'],
                            [{'list': 'ordered'}, {'list': 'bullet'}],
                            ['link', 'image', 'video'],
                            [{'align': []}],
                            [{'header': [1, 2, 3, 4, 5, 6, false]}],
                            ['clean']
                        ],
                        history: {
                            delay: 1000,
                            maxStack: 50,
                            userOnly: false
                        },
                        // imageImport: true,
                        imageResize: {
                            displaySize: true
                        },
                        imageUpload: {}
                    }
                },
                relationItems: {},
                relationsTitle: '',
                relationsEntity: '',
                mainLanguage: this.$parent.mainLanguage,
                languages: this.$parent.languages,
                activeLanguage: this.$parent.activeLanguage,
                errors: [],
                gallery: [
                    {image: null}
                ],
                multipleRelationData: {},
                editDate: null
            }
        },
        watch: {
            multipleRelationData: {
                handler: function (val, oldVal) {
                    let a = [];
                    for (let j in val) {
                        if (val.hasOwnProperty(j)) {
                            let ids = [];
                            _.forEach(val[j], (id) => {
                                _.forEach(this.relationItems[j], (obj) => {
                                    if (obj.id === id) {
                                        ids.push(id);
                                    }
                                });
                            });
                            a = a.concat(ids);
                        }
                    }
                    this.item[this.column.field] = a;
                },
                deep: true
            },
            editDate: function (val, oldVal) {
                this.$bus.$emit('editDate', {
                    data: val,
                    field: this.column.field
                });
            }
        },
        methods: {
            setDate() {
                let date = this.item[this.column.field];
                date = date.slice(0, -3).replace(' ', 'T');
                this.$set(this, 'editDate', date)
            },
            getPhoto(id) {
                document.getElementById(id).click();
            },
            onImageChange(event, index) {
                let files = event.target.files || event.dataTransfer.files;
                if (!files.length) return;

                let fileTypes = ['jpg', 'jpeg', 'png'];
                let extension = files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
                    isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types

                if (isSuccess) {
                    this.readFileOrig(files[0], index);
                }
                else {
                    alert('It is not a picture. Please, use a picture')
                }
                event.preventDefault()
            },
            readFileOrig(file, index) {
                let reader = new FileReader();
                if (this.column.position === 'gallery') {
                    reader.onloadend = () => {
                        this.$set(this.item[this.column.field][index], this.column.relation_field, reader.result);
                        this.item[this.column.field].push({image: null});
                    };
                } else {
                    reader.onloadend = () => {
                        this.$set(this.item, this.column.field, reader.result);
                    };
                }
                if (file) {
                    reader.readAsDataURL(file);
                }
            },
            deletePhoto(index) {
                if (this.column.position === 'gallery') {
                    if (this.item[this.column.field].length > 1) {
                        this.item[this.column.field].splice(index, 1);
                    } else {
                        this.$set(this.item[this.column.field][index], this.column.relation_field, null);
                    }
                } else {
                    this.$set(this.item, this.column.field, null);
                }
            },
            image(type, index = null) {
                if (this.column.position === 'gallery') {
                    return this.item[this.column.field][index]['original_' + type + '_url'];
                } else {
                    return this.item['original_' + type + '_url'];
                }
            },
            getRelations() {
                if (this.column.type === 'belongsTo' || this.column.type === 'belongsToMany') {
                    let url = '/admin/' + this.column.relation;
                    if (this.column.multiple) {
                        url += '/' + this.item.id
                    }
                    axios.get(url)
                        .then((response) => {
                            this.relationsTitle = response.data.title;
                            this.relationsEntity = response.data.entity;
                            this.relationItems = response.data.items;
                            if (this.column.multiple) {
                                for (let index in response.data.items) {
                                    if (response.data.items.hasOwnProperty(index)) {
                                        this.$set(this.multipleRelationData, index, this.item[this.column.field])
                                    }
                                }
                            }
                        })
                        .catch((error) => {
                            console.log(error)
                        })
                }
            },
            selectFile() {
                this.item[this.column.field] = document.querySelector('#' + this.column.title).files[0];
            },
            getFieldTitle(key) {
                return key.split('-')[1];
            }
        }
    }
</script>
<style>
    .ql-container {
        height: 350px !important;
    }

    .help-block {
        display: block;
        color: #ff5454;
    }
</style>