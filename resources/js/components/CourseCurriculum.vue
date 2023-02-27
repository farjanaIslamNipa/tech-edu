<template>
    <div class="pb-5 pt-5 bg-white">
<!--        {{subscriptionCategories}}-->
        <div class="container">
            <h1 class="text-blue text-700 text-center mb-4">Our Programs</h1>
            <CourseCurriculumNav
                :subscriptionCategories="subscription"
                @displayCourse="courseData($event)"
            />
            <div v-if="currentSubscriptionItem?.course_modules?.length" class="pt-lg-5 pt-4 mt-lg-3 mt-2 course-curriculum-carousel mx-md-0 mx-3">
                <div class="row justify-content-center">
                    <div v-for="(subscriptionItem, itemIndex) in currentSubscriptionItem.course_modules" :key="itemIndex" class="col-lg-4 col-md-6 mb-4">
                        <!-- <p>{{ currentSubscriptionItem.media[0].original_url }} dfsdf</p> -->
                        <CourseCurriculumCard :courseColorCode="currentSubscriptionItem.course_color_code" :backgroundColorCode="currentSubscriptionItem.background_color_code" :subscriptionItems="subscriptionItem" :itemIndex="itemIndex" :image="currentSubscriptionItem?.media?.[0]?.original_url" />
                    </div>
                </div>
             <!-- <carousel
                //     ref="carousel"
                //     :navigationEnabled=true
                //     :touchDrag=true
                //     :paginationEnabled=false
                //     :mouseDrag="true"
                //     :speed=1000
                //     :per-page-custom="[[320, 1], [575, 2],[1024, 2]]"
                //     >
                //     <slide v-for="(subscriptionItem, itemIndex) in currentSubscriptionItem.course_modules" :key="itemIndex">
                //         <CourseCurriculumCard :courseColorCode="currentSubscriptionItem.course_color_code" :backgroundColorCode="currentSubscriptionItem.background_color_code" :subscriptionItems="subscriptionItem" :itemIndex="itemIndex" />
                //     </slide>
                // </carousel> -->

            </div>
            <div v-else><h3 class="text-center py-4 px-4 bg-white text-danger rounded mt-5">No program available right now!</h3></div>
            <div v-if="currentSubscriptionItem?.course_modules?.length" class="text-center mt-3">
                <!-- <a href="/current-courses" class="btn show-all-course-btn px-5">Show All</a> -->
                <a href="/all-programs" class="btn show-all-course-btn px-5">Show All</a>
            </div>
        </div>
    </div>
</template>

<script>
import {Carousel, Slide} from '@jambonn/vue-concise-carousel';
import '@jambonn/vue-concise-carousel/lib/vue-concise-carousel.css'
import CourseCurriculumNav from './CourseCurriculumNav.vue'
import CourseCurriculumCard from './CourseCurriculumCard.vue'

export default {
    name: 'CourseCurriculum',
    props: ['subscription'],
    components: {
        Carousel,
        Slide,
        CourseCurriculumNav,
        CourseCurriculumCard
    },
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

<style>
.show-all-course-btn {
    color: var(--blue);
    border: 1px solid var(--blue);
    background-color: white;
    font-weight: 600;
    font-family: var(--fontBubblegum);
    box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px 0px;
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: all 0.3s ease;
}

.show-all-course-btn:hover {
    color: var(--brandColor);
    letter-spacing: 3px;
    box-shadow: rgba(0, 0, 0, 0.2) 0px 11.3115px 40px 0px;
}

</style>
