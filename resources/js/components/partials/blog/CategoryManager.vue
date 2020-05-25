<template>
    <section class="category-manager">
        <hr>

        <div class="form-group">
            <label for="Create Categories">Create Categories</label>
            <input type="text" @keyup="validate()" class="form-control" ref="newCategory">
            <br>
            <button :disabled="isDisabled" class="btn btn-primary text-white" ref="createCategoryBtn" @click.prevent="createCategory()">
                <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span v-else>Create Category</span>
            </button>
        </div>

        <div class="form-group">
            <label for="Categories">Available Categories</label>
            <div class="container d-flex">
                <div class="category-holder" v-for="(category, index) in availableCategories">
                    <a @click="addCategory(category)" class="badge badge-pill badge-primary category-badge">
                        {{ category.name }}
                    </a>
                    <span @click="deleteCategory(index, category.id)" class="close-btn" aria-hidden="true">&times;</span>
                </div>
                <input v-for="(category, index) in availableCategories" type="hidden" :name="'availableCategories['+index+']'" :value="category.name">
            </div>
        </div>

        <div class="form-group">
            <label for="Selected Categories">Selected Categories</label>
            <div class="container" v-if="selectedCategories.length">
                <a v-for="(category, index) in selectedCategories" class="badge badge-pill badge-success category-badge">
                    {{ category.name }} <span @click="removeCategory(index)" aria-hidden="true">&times;</span>
                </a>
                <input v-for="(category, index) in selectedCategories" type="hidden" :name="'selectedCategories['+index+']'" :value="category.id">
            </div>
            <div class="container" v-else>
                No Categories Selected!
            </div>
        </div>
    </section>
</template>
<script>
    const axios = require('axios');
    export default {
        props: ['categories', 'postCategories'],
        data() {
            return {
                availableCategories: this.categories,
                selectedCategories: this.postCategories,
                loading: false,
                isDisabled: true
            }
        },
        methods: {

            validate() {
                this.$refs.newCategory.value.length ? this.isDisabled = false: this.isDisabled = true;
            },

            // Check if category already exists
            hasDuplicateCategoryName(input) {
                let hasDuplicate = false;
                this.availableCategories.forEach(function(obj) {
                    if(input === obj.name) {
                        hasDuplicate = true;
                    }
                });
                return hasDuplicate;
            },

            // Create New categories
            createCategory() {
                if(!this.hasDuplicateCategoryName(this.$refs.newCategory.value)) {
                    let _this = this;
                    this.loading = true;
                    axios.get('/auth/category/create', {
                        params: {
                            'name': _this.$refs.newCategory.value
                        }
                    })
                    .then(function (response) {
                        _this.availableCategories.push(response.data.category);
                        _this.loading = false;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                    this.$refs.newCategory.value = null;
                } else {
                    alert('You cannot create the same category twice!');
                }
            },

            // Delete New categories
            deleteCategory(index, id) {
                if(confirm("Are you sure you want to delete this category?")) {
                    let _this = this;
                    this.availableCategories.splice(index, 1);
                    axios.delete('/auth/category/' + id)
                    .then(function (response) {
                        _this.selectedCategories.forEach(function(obj, index) {
                            if(id === obj.id) {
                                _this.selectedCategories.splice(index, 1);
                            }
                        });
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }
            },

            // Adds category to post
            addCategory(category) {
                if(!this.hasDuplicates(this.selectedCategories, category)) {
                    this.selectedCategories.push(category);
                }
            },

            // Removes category from post
            removeCategory(index) {
                this.selectedCategories.splice(index, 1);
            },

            // Checks if array of objects has same id of a compared object
            hasDuplicates(arrayToCheck, objectToCompare) {
                let hasDuplicate = false;
                arrayToCheck.forEach(function(obj) {
                    if(obj.id === objectToCompare.id) {
                        hasDuplicate = true;
                    }
                });
                return hasDuplicate;
            }
        }
    }
</script>