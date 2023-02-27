<template>
    <div>
        <div class="container">
            <div class="row py-lg-5 py-0">
                <div class="col-lg-8 col-12">
                    <div class="package-details-layout-card bg-white px-4 py-4 mb-4">
                        <h5 class="text-brand text-700">This Package includes:</h5>
                        <div v-if="package?.course_modules?.length" class="row pt-3">
                            <div v-for="(packageModule, index) in package.course_modules" :key="index"
                                class="col-md-6 mb-4">
                                <div class="package-details-card px-4 py-4 h-100">
                                    <h6 class="text-700 text-capitalize">
                                        <a class="course-name" :href="'/program-module/' + packageModule.slug">{{
                                                packageModule.name
                                        }}</a>
                                    </h6>
                                    <p class="mb-0">{{ packageModule.short_description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="package-details-layout-card bg-white px-4 py-4">
                        <div class="d-flex justify-content-between">
                            <h5 class="text-brand mb-0 text-700">Make your own package</h5>
                            <div>
                                <table>
                                    <tbody>
                                        <tr v-if="packagePrice">
                                            <td>
                                                <h6 class="text-600 mb-0">Package Price:</h6>
                                            </td>
                                            <td>
                                                <h6 class="text-600 mb-0 text-right">${{ (packagePrice / 100) }}</h6>
                                            </td>
                                        </tr>
                                        <tr v-if="packageDiscountablePrice">
                                            <td>
                                                <h6 class="text-600 mb-0">Discount:</h6>
                                            </td>
                                            <td>
                                                <h6 class="text-600 mb-0 text-right">${{ (packageDiscountablePrice /
                                                        100)
                                                }}</h6>
                                            </td>
                                        </tr>
                                        <tr v-if="packageGstPrice">
                                            <td>
                                                <h6 class="text-600 mb-0">GST:</h6>
                                            </td>
                                            <td>
                                                <h6 class="text-600 mb-0 text-right">${{ (packageGstPrice / 100) }}</h6>
                                            </td>
                                        </tr>
                                        <tr v-if="packageTotalPrice">
                                            <td>
                                                <h5 class="text-700 text-blue mb-0">Total:</h5>
                                            </td>
                                            <td>
                                                <h5 class="text-700 text-blue mb-0 text-right">${{ (packageTotalPrice /
                                                        100)
                                                }}</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>
                        <div class="pt-4">
                            <div>
                                <h6 class="text-700 header-box">Select your time duration:</h6>
                                <div v-if="package?.package_types?.length" class="pt-3">
                                    <div v-for="(packageType, index) in package.package_types" :key="index"
                                        class="time-selector-checkbox mb-2">
                                        <input v-model="selectedPackageType" :value="packageType"
                                            class="time-selector-checkbox-input" :id="index + 'time-selector'"
                                            name="time-selector" type="radio" />
                                        <label class="time-selector-checkbox-label"
                                            :for="index + 'time-selector'"><span>
                                                <svg width="12px" height="10px" viewbox="0 0 12 10">
                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                </svg></span>
                                            <strong style="font-size:15px;" class="d-inline-block ml-2">{{
                                                    packageType.type
                                            }}</strong>
                                            <strong v-if="packageType.discount_percentage" style="font-size:15px;"
                                                class="d-inline-block ml-2">(Get {{
                                                        packageType.discount_percentage
                                                }} % discount)</strong>
                                        </label>
                                    </div>
                                    <p v-if="courseDurationError" class="mb-0 text-danger text-600">Please select time duration</p>
                                </div>
                            </div>
                            <div class="pt-5 pb-4">
                                <h6 class="text-700 header-box">Select Courses:
                                    <span v-if="minimumCourseCount" style="font-size:14px" class="text-danger">
                                        (max: {{ minimumCourseCount }})
                                    </span>
                                </h6>
                                <div v-if="package?.course_modules?.length" class="row pt-3">
                                    <div v-for="(course, index) in package.course_modules" :key="index"
                                        class="col-md-4 col-sm-6 col-12 mb-4">
                                        <div class="h-100">
                                            <label class="radio-one-container">
                                                <input @click="getCourse($event)" v-model="selectedCourse" :value="course" class="radio-one-input"
                                                    type="checkbox" name="course_module" :id="index + 'package'" />
                                                <div class="radio-one-content">
                                                    <span class="text-capitalize px-2 py-2 text-600">
                                                        {{ course.name }} (${{ Math.round(course.price / 100) }})
                                                    </span>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <p v-if="courseSelectionError" class="text-danger text-600"><span><i class="fa-solid fa-circle-exclamation"></i></span> You have already selected the maximum number of courses</p>
                            </div>
                        </div>
                        <div class="text-right pb-3">
                            <button title="Select minimum 3 courses" :disabled="isDisabled"
                                :class="isDisabled ? 'enroll-disabled' : 'package-enroll-btn'" @click="getClientInfo()"
                                class="btn px-4 text-capitalize">enroll now
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 d-lg-block d-none">
                    <div class="package-details-layout-card bg-white px-4 py-4">
                        <h6 class="text-brand font-weight-bold">Package Details</h6>
                        <p v-html="package.description"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="" data-toggle="modal" data-target="#getClientInformation"></div>

    <!--    client information modal-->
    <div class="modal fade" id="getClientInformation" tabindex="-1" role="dialog" aria-labelledby="clientInfoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="py-4 px-4">
                        <h3 class="pb-3"> Your Package Subscription Details:</h3>
                        <h6 v-if="packagePrice" class="text-left  text-700">Package: <span v-html="package.name"
                                class="text-blue mb-0"></span>
                        </h6>
                        <div class="d-flex">
                            <h6 class=" text-700">Courses:&nbsp;</h6>
                            <ul class="text-left m-0 p-0">
                                <li style="list-style:none;" v-for="(course, index) in selectedCourse" :key="index">
                                    {{ course.name }}
                                </li>
                            </ul>
                        </div>
                        <h6 class="text-left text-700 my-3">Package Type/Duration: <span>{{ selectedPackageType.type }}</span></h6>
                        <h6 class="text-700">Price Details:</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6 v-if="packagePrice">Package Price:</h6>
                                        </td>
                                        <td class="pr-2">
                                            <h6>$ {{ (packagePrice / 100) }}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 v-if="packagePrice">Discount:</h6>
                                        </td>
                                        <td class="pr-2">
                                            <h6>$ {{ (packageDiscountablePrice / 100) }}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 v-if="packageGstPrice">GST Price: </h6>
                                        </td>
                                        <td class="pr-2">
                                            <h6> $ {{ (packageGstPrice / 100) }}</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h6 class="text-700" v-if="packageTotalPrice">Total Price:</h6>
                                        </td>
                                        <td class="pr-2">
                                            <h6 class="text-700"> $ {{ (packageTotalPrice / 100) }}</h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <h6 class="text-left text-brand"> *Complete Your Package Subscription Please Give Below Information </h6>
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <input v-model="clientInfo.firstName" name="first_name" id="firstName" type="text"
                                        class="contact-us-form-input" placeholder="First Name *" required>
                                    <div class="text-danger"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <input v-model="clientInfo.lastName" id="lastName" type="text"
                                        class="contact-us-form-input" placeholder="Last Name">
                                    <div class="text-danger"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <input v-model="clientInfo.phoneNumber" id="phoneNumber" type="text"
                                        class="contact-us-form-input" placeholder="Contact Phone *" required>
                                    <div class="text-danger"></div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <input v-model="clientInfo.emailAddress" name="email" id="email" type="email"
                                        class="contact-us-form-input" placeholder="Email Address *" required>
                                    <div class="text-danger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button @click="subscriptionFromSubmit" class="btn order-submit-btn">Submit</button>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
//mixin
import ShowToastMessage from './mixins/ShowToastMessage';
import Loader from './mixins/Loader';
// packages
import { load } from 'recaptcha-v3';
export default {
    name: 'PackageDetails',
    mixins: [ShowToastMessage, Loader],
    props: ['package', 'csrfToken', 'submitRoute'],
    data() {
        return {
            selectedPackageType: {},
            minimumCourseCount: 0,
            packagePrice: 0,
            selectedCourse: [],
            courseDurationError:false,
            courseSelectionError:false,
            enrollActive: false,
            packageDiscountablePrice: 0,
            packageGstPrice: 0,
            packageTotalPrice: 0,
            clientInfo: {
                firstName: '',
                lastName: '',
                phoneNumber: '',
                emailAddress: ''
            }
        }
    },
    computed: {
        // Condition to disable submit button
        isDisabled() {
            return !this.selectedPackageType.id || !(this.minimumCourseCount === this.selectedCourse.length) ? true : false

        },
    },
    watch: {
        selectedPackageType(selectedPackageType) {
            if(this.selectedCourse.length > 0 && this.selectedPackageType ){
                this.selectedCourse = [];
            }
            this.courseDurationError = false;
            this.package?.package_types?.map(packageType => {
                if (packageType.id == selectedPackageType.id) {
                    this.minimumCourseCount = packageType.minimum_course_count
                }
            })
        },
        selectedCourse(selectedCourse) {
            let courseModules = [];
            selectedCourse.map((item) => {
                let singleCourseModule = this.package.course_modules.find((singleCourse) => singleCourse.id === item.id);
                if (singleCourseModule) {
                    courseModules.push(singleCourseModule);
                }
            });
            this.packagePrice = courseModules.reduce((res, current) => res + (current.price), 0);
            this.packageDiscountablePrice = (this.packagePrice * this.selectedPackageType.discount_percentage / 100);
            this.packageGstPrice = ((this.packagePrice - this.packageDiscountablePrice) * 10 / 100);
            this.packageTotalPrice = this.packagePrice - this.packageDiscountablePrice + this.packageGstPrice;
            if(this.minimumCourseCount && (this.selectedCourse.length === this.minimumCourseCount)){
                this.courseSelectionError = true;
            }
            if(this.minimumCourseCount && (this.selectedCourse.length < this.minimumCourseCount)){
                this.courseSelectionError = false;
            }
        }

    },
    methods: {
        getCourse(e){
            if(this.selectedCourse.length >= this.minimumCourseCount){
                e.target.checked = false;
            }
            if(this.selectedCourse.length === 0 && !this.selectedPackageType.id){
                this.courseDurationError = true;
            }


        },
        getClientInfo() {
            document.querySelector('[data-target="#getClientInformation"]').click();
        },

        async subscriptionFromSubmit() {
            let loader = this.loader(true);
            const recaptcha = await load(process.env.MIX_GOOGLE_RECAPTCHA_SITE_KEY);
            const token = await recaptcha.execute('packageSubscriptionFrom');

            let dataObj = {
                package_id: this.package.id,
                package_type_id: this.selectedPackageType.id,
                course_module_id: this.selectedCourse.map(item => {
                    return item.id;
                }),
                first_name: this.clientInfo.firstName,
                last_name: this.clientInfo.lastName,
                phone_number: this.clientInfo.phoneNumber,
                email: this.clientInfo.emailAddress,
                'g-recaptcha-response': token,
                _token: this.csrfToken,
            };

            await axios.post(this.submitRoute, dataObj).then(async (response) => {
                console.log("Success: ", response)
                if (response.status === 201) {
                    const toastObj = {
                        message: "You have successfully submitted your package subscription request. An email will send to you. Someone from our team will get back to you shortly",
                        type: 'success'
                    };
                    this.showToastMessage(toastObj);
                    location.reload();
                    // this.resetData();
                }
            }).catch(async (errors) => {
                if (errors.response.status === 422 && errors.response.data.message) {
                    const toastObj = { message: errors.response.data.message, type: 'error' };
                    this.showToastMessage(toastObj);
                } else {
                    console.log(errors.response.data.message)
                    const toastObj = {
                        message: `Something is wrong! Please, contact us by email or call or try later.`,
                        type: 'error'
                    };
                    this.showToastMessage(toastObj);
                }
            })
            this.loader(false, loader);


        },

        resetData() {
            this.selectedPackageType = {};
            this.minimumCourseCount = 0;
            this.packagePrice = 0;
            this.selectedCourse = [];
            this.enrollActive = false;
            this.packageDiscountablePrice = 0;
            this.packageGstPrice = 0;
            this.packageTotalPrice = 0;
            this.clientInfo = {
                firstName: '',
                lastName: '',
                phoneNumber: '',
                emailAddress: '',
            }
        }
    },
    async mounted() {
        await load(process.env.MIX_GOOGLE_RECAPTCHA_SITE_KEY)

    }
}
</script>

<style scoped>
.enroll-disabled {
    background-color: gray;
    color: white;
    border: 2px solid gray;
}

.package-enroll-btn {
    background-color: var(--blue);
    border: 2px solid var(--blue);
    color: white;
    border-radius: 5px;
    transition: all 0.3s ease;
    text-transform: capitalize;
}

.package-details-card {
    background-color: #E7E5ED;
    border-radius: 8px;
}

.time-selector-checkbox input[type="radio"] {
    display: none;
    visibility: hidden;
}

.time-selector-checkbox .time-selector-checkbox-label {
    margin: auto;
    -webkit-user-select: none;
    user-select: none;
    cursor: pointer;
}

.time-selector-checkbox .time-selector-checkbox-label span {
    display: inline-block;
    vertical-align: middle;
    transform: translate3d(0, 0, 0);
}

.time-selector-checkbox .time-selector-checkbox-label span:first-child {
    position: relative;
    width: 18px;
    height: 18px;
    border-radius: 3px;
    transform: scale(1);
    vertical-align: middle;
    border: 1px solid #9098A9;
    transition: all 0.2s ease;
}

.time-selector-checkbox .time-selector-checkbox-label span:first-child svg {
    position: absolute;
    top: 3px;
    left: 2px;
    fill: none;
    stroke: #FFFFFF;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-dasharray: 16px;
    stroke-dashoffset: 16px;
    transition: all 0.3s ease;
    transition-delay: 0.1s;
    transform: translate3d(0, 0, 0);
}

.time-selector-checkbox .time-selector-checkbox-label span:first-child:before {
    content: "";
    width: 100%;
    height: 100%;
    background: var(--brandColor);
    display: block;
    transform: scale(0);
    opacity: 1;
    border-radius: 50%;
}

.time-selector-checkbox .time-selector-checkbox-label span:last-child {
    padding-left: 8px;
}

.time-selector-checkbox .time-selector-checkbox-label:hover span:first-child {
    border-color: var(--brandColor);
}

.time-selector-checkbox .time-selector-checkbox-input:checked+.time-selector-checkbox-label span:first-child {
    background: var(--brandColor);
    border-color: var(--brandColor);
    animation: wave 0.4s ease;
}

.time-selector-checkbox .time-selector-checkbox-input:checked+.time-selector-checkbox-label span:first-child svg {
    stroke-dashoffset: 0;
}

.time-selector-checkbox .time-selector-checkbox-input:checked+.time-selector-checkbox-label span:first-child:before {
    transform: scale(3.5);
    opacity: 0;
    transition: all 0.6s ease;
}

@keyframes wave {
    50% {
        transform: scale(0.9);
    }
}

.course-name {
    color: rgb(19, 19, 19);
    text-decoration: none;
}

.course-name:hover {
    color: var(--blue);
    /* text-decoration: underline; */
    transition: all 0.3s ease;
}

/* package selector css */
.radio-one-container {
    position: relative;
    width: 100%;
    height: 100%;
    float: left;
    border: 2px solid var(--brandColor);
    box-sizing: border-box;
    border-radius: 5px;
}

.radio-one-container .radio-one-content {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    line-height: 25px;
    transition: .3s ease;
}

.radio-one-container .radio-one-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.radio-one-input[type=checkbox]:checked~.radio-one-content {
    background-color: var(--brandColor);
    color: white;
}

@keyframes slidein {
    from {
        margin-top: 100%;
        width: 300%;
    }

    to {
        margin: 0%;
        width: 100%;
    }
}

.header-box {
    background-color: #e7e5ed4f;
    padding: 8px;
    border-radius: 5px;
}
</style>
