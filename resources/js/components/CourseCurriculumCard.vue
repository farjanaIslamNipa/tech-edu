<template>
<div class="program-card h-100 position-relative">
    <div class="program-card-img position-relative">
        <img v-if="subscriptionItems?.media[0]?.original_url" :src="subscriptionItems?.media[0]?.original_url" alt="Course Program">
        <img v-else src="../../../public/default/images/backend/no-image.png" alt="Course Program">
        <div class="price-box">
            <h5 class="subscription-price mb-0 py-3 px-2 text-center text-white">${{Math.round(subscriptionItems.price/100)}} /<small style="font-size: 14px;font-weight:bold">Per session</small></h5>
        </div>
    </div>
    <h4 class="mt-4 mb-3 text-brand">{{subscriptionItems.name}}</h4>
    <p class="mb-5">{{subscriptionItems.short_description}}</p>
    <div class="program-card-btn">
        <div class="d-flex align-items-center justify-content-between mt-3">
            <div><a class="learn-more-btn" :href="'/program-module/'+subscriptionItems.slug">Learn More</a></div>
            <div><a class="enroll-now-btn" :href="subscriptionItems.payment_link" target="_blank">Enroll Now</a></div>
        </div>
    </div>
</div>
</template>

<script>
export default {
  name: 'CourseCurriculumCard',
  props: ['subscriptionPackage', 'subscriptionItems', 'itemIndex'],
  mounted(){
    console.log(this.subscriptionItems, 'abc xyz')
  }
  }
</script>

<style>
.program-card{
    background-color: rgba(113, 98, 171, 0.1);
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 3px 7px 0 rgba(0, 0, 0, .13), 0 1px 2px 0 rgba(0, 0, 0, .11);
}
.program-card-img{
    height: 240px;
    width: 100%;
}
.program-card-img img{
    height: 100%;
    width: 100%;
    object-fit: cover;
}
.price-box{
    background-color: rgba(113, 98, 171, 0.6);
   position: absolute;
   width: 100%;
   bottom: 0;
}
.program-card-btn{
    position: absolute;
    bottom: 24px;
    width: 89%;
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
}
.learn-more-btn{
    color: var(--brandColor);
    border: 1px solid var(--brandColor);
    border-radius: 4px;
    padding: 6px 20px;
    font-weight: 700;
    transition: all 0.3s ease;
    text-decoration: none !important;
}
.learn-more-btn:hover{
    background-color: var(--brandColor);
    color: white;
}
.enroll-now-btn{
    background-color: var(--brandColor);
    border: 1px solid var(--brandColor);
    color: white;
    border-radius: 4px;
    padding: 6px 20px;
    font-weight: 700;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none !important;
}
.enroll-now-btn:hover{
    background-color: white;
    border: 1px solid var(--brandColor);
    color: var(--brandColor);
    transition: all 0.3s ease;
}
@media (max-width:1199px){
    .program-card-btn{
        width: 92%;
    }
}
@media (max-width:991px){
    .program-card-btn{
        width: 89%;
    }
}
@media (max-width:374px){
    .learn-more-btn, .enroll-now-btn {
        padding: 6px 10px;
    }
}
/* .course-curriculum-carousel .VueCarousel-navigation-prev {
  font-family: none !important;
  border: 1px solid rgb(255, 182, 45);
  border-radius: 50%;
  padding: 6px 8px 5px 6px !important;
  line-height: 1;
  color: var(--orange);
  font-size: 15px;
}

.course-curriculum-carousel .VueCarousel-navigation-next {
  font-family: none !important;
  border: 1px solid rgb(255, 182, 45);
  border-radius: 50%;
  padding: 6px 5px 5px 8px !important;
  line-height: 1;
  color: var(--orange);
  font-size: 15px;
}

.course-curriculum-carousel .VueCarousel-inner {
  margin-bottom: 20px !important;
}

.subscription-slider-card {
  margin-top: 20px;
  padding-top: 40px;
  box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
}

.subscription-slider-card:before,
.subscription-slider-card:after {
  z-index: -1;
  position: absolute;
  content: "";
  bottom: 15px;
  left: 10px;
  width: 50%;
  top: 80%;
  max-width: 300px;
  background: #777;
  -webkit-box-shadow: 0 15px 10px #777;
  -moz-box-shadow: 0 15px 10px #777;
  box-shadow: 0 15px 10px #777;
  -webkit-transform: rotate(-3deg);
  -moz-transform: rotate(-3deg);
  -o-transform: rotate(-3deg);
  -ms-transform: rotate(-3deg);
  transform: rotate(-3deg);
}

.subscription-slider-card:after {
  -webkit-transform: rotate(3deg);
  -moz-transform: rotate(3deg);
  -o-transform: rotate(3deg);
  -ms-transform: rotate(3deg);
  transform: rotate(3deg);
  right: 10px;
  left: auto;
}

.subscription-price {
  display: inline-block;
  font-size: 28px;
  font-weight: 600;
  padding: 2px 40px;
  color: white;
  background-size: 100% 200%;
}

.green-border {
  width: 100%;
}

.book-online-btn {
  cursor: pointer;
  text-align: center;
  padding: 17px 0;
  font-size: 21px;
  font-weight: 700;
  background-size: 100% 200%;
  -webkit-transition: background-position 0.5s;
  -moz-transition: background-position 0.5s;
  transition: background-position 0.5s;
}

.book-online-btn a {
  color: white;
  font-size: 21px;
  font-weight: 700;
  text-decoration: none;
}

.slider-card-header-height {
  min-height: 80px;
}
.truncate-text{
    cursor: pointer;
    font-style: italic;
    font-size: 15px;
}
.review-height{
  height: auto;
  transition: height 0.3s ease;
} */
</style>
