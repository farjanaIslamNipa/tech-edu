<template>
    <div class="row">

        <div class="col-12 col-sm-12 col-md-8">
            <div class="form-group">
                <label for="name">Package Name *</label>
                <input v-model="name" type="text" name="name" id="name" class="form-control"
                       placeholder="Enter Package Name">
                <div v-if="errors.name" class="text-danger">{{ errors.name[0] }}</div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-4">
            <div class="form-group">
                <label> Package Status *</label>
                <select v-model="status" class="form-control js-basic-select2" name="status">
                    <option value="1" :selected="status === '1'">Active</option>
                    <option value="0" :selected="status === '0'">Inactive</option>
                </select>
                <div v-if="errors.status" class="text-danger">{{ errors.status[0] }}</div>
            </div>
        </div>

        <!--package types-->
        <div class="col-12 ">
            <div class="h6"><strong>Package Types *</strong></div>

            <div style="border-style: outset; border-color:#0a53be" class="row p-1 m-1" v-for="(singlePackage,index) in packageTypes" :key="index">
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <label>Types *</label>
                        <input v-model="singlePackage['type']" type="text" :name="`package_type[${index}][type]`"
                               id="type" class="form-control"
                               placeholder="Ex: 6 hours, 10 hours, 20 hours">
                        <div v-if="errors[`package_type.${index}.type`]" class="text-danger">
                            {{ errors[`package_type.${index}.type`][0] }}
                        </div>

                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <label>Discount Percentage</label>
                        <input v-model="singlePackage['discount_percentage']" type="text"
                               :name="`package_type[${index}][discount_percentage]`" id="discountPercentage"
                               class="form-control"
                               placeholder="0.5, 10, 20">
                        <div v-if="errors[`package_type.${index}.discount_percentage`]" class="text-danger">
                            {{ errors[`package_type.${index}.discount_percentage`][0] }}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <label>Minimum Course *</label>
                        <input v-model="singlePackage['minimum_course_count']" type="text"
                               :name="`package_type[${index}][minimum_course_count]`" id="minimumCourseCount"
                               class="form-control"
                               placeholder="Ex: 3, 4, 20">
                        <div v-if="errors[`package_type.${index}.minimum_course_count`]" class="text-danger">
                            {{ errors[`package_type.${index}.minimum_course_count`][0] }}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-8">
                    <div class="form-group">
                        <label>Payment Link</label>
                        <input v-model="singlePackage['payment_link']" type="text" :name="`package_type[${index}][payment_link]`" id="paymentLink" class="form-control"
                               placeholder="Enter Payment Link">
                        <div v-if="errors[`package_type.${index}.payment_link`]" class="text-danger">{{ errors[`package_type.${index}.payment_link`][0]}}</div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-2">
                    <div class="form-group">
                        <label>Type Status *</label>
                        <select class="form-control js-basic-select2" :name="`package_type[${index}][status]`">
                            <option value="1" :selected="singlePackage['status'] === '1'">Active</option>
                            <option value="0" :selected="singlePackage['status'] === '0'">Inactive</option>
                        </select>
                        <div v-if="errors[`package_type.${index}.status`]" class="text-danger">
                            {{ errors[`package_type.${index}.status`][0] }}
                        </div>

                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-2">
                    <div class="form-group">
                        <label style="visibility: hidden">Action</label>
                        <div class="d-flex justify-content-center">
                            <button type="button" @click="addOrRemovePackageType(singlePackage.id)" class="btn w-100"
                                    :class="index=== 0 ? 'btn-info': 'btn-danger' ">
                                {{ index === 0 ? 'Add Item' : 'Remove' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                <label>Short Description *</label>
                <textarea class="form-control" v-model="shortDescription" name="short_description" rows="3"
                          placeholder="Write a Short Description"> </textarea>
                <div v-if="errors.short_description" class="text-danger">{{ errors.short_description[0] }}</div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label>Description *</label>
                <textarea v-model="description" class="form-control" name="description" rows="12" placeholder="Write a Description"></textarea>
            </div>
        </div>
        <div class="col-12">
            <div>
                <h4 class="text-danger">{{ minimumCourseSelectionAlertMessage }}</h4>
            </div>
            <div class="form-group">
                <label>Select Courses *</label>
                <div v-if="errors.course_module_id" class="text-danger">{{ errors.course_module_id[0] }}</div>
            </div>
        </div>
        <div v-for="(courseModule,index) in courseModules" :key="index"
             class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 form-group">
            <div class="d-flex align-items-start">
                <div>
                    <input  :value="courseModule.id"
                            :id="'course-checkbox-'+courseModule.id"
                            class="btn-check m-1"
                            type="checkbox"
                            name="course_module_id[]"
                            :checked="checkboxIsChecked(courseModule.id)"

                    />
                    <label :for="'course-checkbox-'+courseModule.id">&nbsp;{{ courseModule.name }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-right">
            <button :disabled="!isPackageEditButtonActive" type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "PackageEditForm.vue",
    props: ['courseModules', 'existingPackageData', 'errors'],
    data() {
        return {
            existingPackageSelectedCourseId: [],
            isPackageEditButtonActive: false,
            minimumCourseSelectionAlertMessage: '',
            minimumCourseCourseCount: '',
            name: '',
            shortDescription: '',
            description: '',
            status: 1,
            course_module_id: '',
            selectedCourse: [],

            packageTypes: [
                {
                    id: 1,
                    type: '',
                    status: 1,
                    minimum_course_count: '',
                    discountPercentage: '',
                    paymentLink: '',
                },

            ]
        }
    },
    watch: {
        packageTypes: {
            handler(val) {
                let max = 0;
                val.map((item) => {
                    console.log(item, "item object from package type")
                    const count = item.minimum_course_count === "" ? 0 : item.minimum_course_count;
                    if (parseInt(count) > max) {
                        max = item.minimum_course_count;
                    }
                });
                this.minimumCourseCourseCount = max;
                if (max === 0) {
                    this.minimumCourseSelectionAlertMessage = "";

                    this.minimumCourseSelectionAlertMessage = `Please select at least ${max > 0 ? max : 1} courses`;

                    this.isPackageEditButtonActive = false;
                    return;
                }
                if (max <= (this.selectedCourse.length === 0 ? 1 : this.selectedCourse.length)) {
                    this.isPackageEditButtonActive = true;
                    this.minimumCourseSelectionAlertMessage = "";

                    this.minimumCourseSelectionAlertMessage = `Please select at least ${max > 0 ? max : 1} courses`;
                    return;
                }
                this.minimumCourseSelectionAlertMessage = "";

                this.minimumCourseSelectionAlertMessage = `Please select at least ${max > 0 ? max : 1} courses`;

                this.isPackageEditButtonActive = false;

            },
            deep: true
        },
        selectedCourse: {
            handler(val) {
                let max = 0;

                this.packageTypes.map((item) => {
                    console.log(item, "item object from course type");
                    const count = item.minimum_course_count === "" ? 0 : item.minimum_course_count;

                    if (parseInt(count) > max) {
                        max = item.minimum_course_count;
                    }
                });
                this.minimumCourseCourseCount = max;
                console.log(max);
                if (max === 0) {
                    this.minimumCourseSelectionAlertMessage = "";

                    this.minimumCourseSelectionAlertMessage = `Please select at least ${max > 0 ? max : 1} courses`;

                    this.isPackageEditButtonActive = false;
                    return;
                }
                if (max <= (val.length === 0 ? 1 : val.length)) {
                    this.isPackageEditButtonActive = true;
                    this.minimumCourseSelectionAlertMessage = "";
                    this.minimumCourseSelectionAlertMessage = `Please select at least ${max > 0 ? max : 1} courses`;
                    return;
                }
                this.minimumCourseSelectionAlertMessage = "";
                this.minimumCourseSelectionAlertMessage = `Please select at least ${max > 0 ? max : 1} courses`;
                this.isPackageEditButtonActive = false;

            },
            deep: true
        },

    },

    methods: {
        checkboxIsChecked(courseId) {
            return this.existingPackageSelectedCourseId.includes(courseId);
        },
        addOrRemovePackageType(currentItem) {
            console.log(currentItem, "current titem")
            if (currentItem === this.packageTypes[0].id) {
                this.packageTypes.push({
                    id: this.packageTypes[this.packageTypes.length-1].id + 1,
                    type: '',
                    status: 1,
                    minimum_course_count: '',
                    discountPercentage: '',
                    paymentLink: '',

                })
            } else {
                console.log(currentItem, "remove item ");
                this.packageTypes = this.packageTypes.filter((item) => item.id !== currentItem);
            }
        }
    },
    mounted() {
        console.log(this.$props.existingPackageData, "this.$props.existingPackageData")
        if (this.$props.existingPackageData) {

            this.name = this.$props.existingPackageData?.name ?? '';
            this.shortDescription = this.$props.existingPackageData?.short_description ?? '';
            this.description = this.$props.existingPackageData?.description ?? '';
            this.status = this.$props.existingPackageData?.status ?? 1;
            this.selectedCourse = this.$props?.courseModules ?? [];
            this.packageTypes = this.$props.existingPackageData?.package_types ?? [{
                id: 1,
                type: '',
                status: 1,
                minimum_course_count: '',
                discountPercentage: '',
                paymentLink: '',

            },];

            this.existingPackageSelectedCourseId = this.$props.existingPackageData.course_modules
                ? this.$props.existingPackageData.course_modules.map((courseModule) => {
                    return courseModule.id;
                })
                : [];
        }

    }

}
</script>

<style scoped>

</style>
