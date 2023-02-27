<template>
  <div>
    <div class="d-flex flex-wrap justify-content-center course-type-bar pt-4">
        <div v-for="(subscriptionCategory, categoryIndex) in subscriptionCategories" :key="categoryIndex">
          <!-- {{ subscriptionCategory }} -->
          <input @click="displayContent(subscriptionCategory.id)"  v-model="picked"  class="course-type-input" :value="categoryIndex"  type="radio" name="course-type" :id="`course-type + ${categoryIndex}`" >
            <label :for="`course-type + ${categoryIndex}`" class="course-type-label">
              <span class="text-capitalize text-brand fw-bold">{{ subscriptionCategory.name }} </span>

              <div class="triangle">
                <!-- border-top: 20px solid var(--orange); -->
              </div>
            </label>
        </div>
      </div>
  </div>
</template>

<script>
  export default {
    name:'CourseCurriculumNav',
    props: ['subscriptionCategories','test'],

    data() {
        return {
          picked:0,
          selectedCategory:''
        }
    },
    methods:{
      displayContent(id) {
        this.selectedCategory = id;
        this.$emit("displayCourse", id);
      },
    },

  }
</script>

<style scoped>
.course-type-label{
  background-color: #fff;
  height: 60px;
  width: 200px;
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  cursor: pointer;
  padding: 0 10px;
  transition: all 0.3s ease;
  text-align: center;
  position: relative;
  box-shadow: 0px 2px 4px 1px rgb(0 0 0 / 8%);
}
.triangle{
  height: 0;
  width: 0;
  border-top: 20px solid var(--brandColor);
  border-right: 98px solid transparent;
  border-bottom: 0em solid transparent;
  border-left: 98px solid transparent;
  position: absolute;
  bottom: 0;
  opacity: 0;
  top: 60px;
}
.course-type-input{
  display: none;
}

.course-type-input:checked + .course-type-label {
  background-color: var(--brandColor);
}

.course-type-input:checked + .course-type-label .triangle{
  opacity: 1;
}
.course-type-label span{
  font-weight: 700;
  text-transform: capitalize;
  line-height: 1.2;
}
.course-type-input:checked + .course-type-label span{
  color: #fff !important;
}

@media(max-width:1199px){
  .course-type-label{
    height: 50px;
    width: 170px;
  }
  .course-type-label span{
    font-size: 15px;
  }
  .triangle{
  border-top: 20px solid var(--brandColor);
  border-right: 83px solid transparent;
  border-bottom: 0em solid transparent;
  border-left: 83px solid transparent;
  top: 50px;
}
}
@media(max-width:991px){
  .course-type-label{
    height: 50px;
    width: 138px;
  }
  .course-type-label span{
    font-size: 15px;
    font-weight: 500;
  }
  .triangle{
  border-top: 15px solid var(--brandColor);
  border-right: 68px solid transparent;
  border-bottom: 0em solid transparent;
  border-left: 68px solid transparent;
  top: 50px;
}
}
@media(max-width:767px){
    .course-type-label{
    height: 50px;
    width: 200px;
    margin-bottom: 1px !important;
  }
  .course-type-label span{
    font-size: 16px;

  }
  .triangle{
  opacity: 0 !important;
}
}
@media(max-width:529px){
  .course-type-label{
    height: 50px;
    width: 200px;
    margin-bottom: 1px !important;
  }
  .course-type-label span{
    font-size: 16px;

  }
  .triangle{
  opacity: 0 !important;
}
}

</style>
