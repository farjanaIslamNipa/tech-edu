require('./bootstrap')

// core packages.
import { createApp } from 'vue'

// components
import CourseCurriculum from './components/CourseCurriculum.vue'
import AllCurrentCourses from './components/AllCurrentCourses.vue'
import PackageDetails from './components/PackageDetails.vue'
import PackageCreateForm from './components/PackageCreateForm.vue'
import PackageEditForm from "./components/PackageEditForm";

// 3rd party packages.
import VueToast from 'vue-toast-notification';
import VueLoading from 'vue-loading-overlay';

// package css
import 'vue-toast-notification/dist/theme-sugar.css'; // vue-toast css
import 'vue-loading-overlay/dist/vue-loading.css'; // // vue-loading-overlay or loader spinner

// *********************************************


// *********************************************

// Course Curriculum App
const courseCurriculumApp = createApp({});

// register packages.
courseCurriculumApp.use(VueToast);
courseCurriculumApp.use(VueLoading);

// register components.
courseCurriculumApp.component('course-curriculum', CourseCurriculum);
courseCurriculumApp.component('all-current-courses', AllCurrentCourses);
courseCurriculumApp.component('package-details', PackageDetails);
courseCurriculumApp.component('package-create-form', PackageCreateForm);
courseCurriculumApp.component('package-edit-form', PackageEditForm);


// mount
courseCurriculumApp.mount('#course_curriculum')
courseCurriculumApp.mount('#all_current_courses')
courseCurriculumApp.mount('#package_details')
courseCurriculumApp.mount('#package-create-form')
courseCurriculumApp.mount('#package-edit-form')

