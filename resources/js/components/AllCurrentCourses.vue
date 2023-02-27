<template>
  <div class="mb-5">
    <div class="current-courses-bg">
      <div class="container">
        <h1 class="text-blue text-center text-ellipsis mb-4">All Current Programs</h1>
        <CourseCurriculumNav
          :subscriptionCategories="subscription"
          @displayCourse="courseData($event)"
        />
      </div>
    </div>
    <div class="container">
      <div v-if="currentSubscriptionItem?.course_modules?.length" class="row pt-2">
          <div v-for="(subscriptionItem, itemIndex) in currentSubscriptionItem.course_modules" :key="itemIndex" class="col-lg-4 col-md-6 px-1 mb-4">
            <CourseCurriculumCard :subscriptionItems="subscriptionItem" :itemIndex="itemIndex" />
          </div>
        </div>
        <div v-else><h3 class="text-center py-4 px-4 bg-white text-danger rounded mt-5">No program available right now!</h3></div>
    </div>
  </div>
</template>

<script>
import CourseCurriculumNav from './CourseCurriculumNav.vue';
import CourseCurriculumCard from './CourseCurriculumCard.vue';
  export default {
    name: "AllCurrentCourses",
    components: { CourseCurriculumNav, CourseCurriculumCard },
    props: ['subscription'],
    data(){
        return{
            courseType:'',
            currentSubscriptionItem:{}
        }
    },
    methods:{
        courseData(id) {
            this.currentSubscriptionItem = this.subscription.find((item) => item.id === id);
        },
    },
    mounted() {
        this.currentSubscriptionItem = this.subscription?.[0] ?? [];
    }
}
</script>

<style scoped>
.current-courses-bg{
  background-image: url('../../../public/images/frontEnd/current-courses-bg.png');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center center;
  padding: 90px 0 60px;
}
</style>
