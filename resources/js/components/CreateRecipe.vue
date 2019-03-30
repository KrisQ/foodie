<template>
  <el-card class="box-card medium-box">
    <div slot="header" class="clearfix">
      <h4 :style="{textAlign: 'center'}">New Recipe</h4>
    </div>
    <el-alert v-if="error" type="error">
      <p>All fields are required 😕</p>
    </el-alert>

    <el-form ref="form" method="post" @keyup.enter="addIngredient(ingresdientsInput)">
      <el-row :gutter="20">
        <el-col :xs="24" :md="24">
          <el-form-item label="Recipe Name">
            <el-input
              type="text"
              id="title"
              placeholder="Boeuf Bourguignon"
              v-model="title"
              required
            ></el-input>
          </el-form-item>
        </el-col>
        <el-col :xs="24" :md="12" :style="{wordWrap: 'break-word', lineHeight: '.2em'}">
          <el-form-item label="Ingredients" @keyup.enter="addIngredient(ingresdientsInput)">
            <el-input
              type="text"
              v-model="ingresdientsInput"
              id="ingresdientsInput"
              placeholder="Butter"
              required
            >
              <el-button
                slot="append"
                @click.prevent="addIngredient(ingresdientsInput)"
              >Add Ingredient</el-button>
            </el-input>
            <br>
            <ul v-if="ingredients.length > 0">
              <li v-for="(ingredient, i) in ingredients" :key="i">
                {{ingredient}}
                <el-button
                  @click="removeIngredient(ingredient)"
                  type="default"
                  size="mini"
                  round
                >Remove</el-button>
              </li>
            </ul>
          </el-form-item>
        </el-col>

        <el-col :xs="24" :md="12" :style="{wordWrap: 'break-word', lineHeight: '.2em'}">
          <el-form-item label="Instructions" @keyup.enter="addIntruction(instructionInput)">
            <el-input
              type="text"
              v-model="instructionInput"
              id="instructionInput"
              placeholder="Add butter"
              required
            >
              <el-button
                slot="append"
                @click.prevent="addInstruction(instructionInput)"
              >Add Instruction</el-button>
            </el-input>
            <br>
            <ol v-if="instructions.length > 0">
              <li v-for="(instruction, i) in instructions" :key="i">
                {{instruction}}
                <el-button
                  @click="removeInstruction(instruction)"
                  type="default"
                  size="mini"
                  round
                >Remove</el-button>
              </li>
            </ol>
          </el-form-item>
        </el-col>

        <el-col :xs="24" :md="24">
          <el-form-item label="Category">
            <el-select v-model="cat" placeholder="Select">
              <el-option
                v-for="(category, i) in categories"
                :key="i"
                :value="category.name"
                @click="selectCat(category.name)"
              ></el-option>
            </el-select>
          </el-form-item>
        </el-col>

        <el-col :xs="24" :md="24">
          <el-form-item label="Image">
            <input
              id="uploadFile"
              type="file"
              name="photo"
              class="form-control-file"
              accept="image/jpeg, image/png, image/jpg"
              @change="uploadPicture"
            >
          </el-form-item>
          <img v-if="img_upload != ''" :src="img_upload" class="img-thumbnail">
          <el-alert v-if="message != ''" type="error">
            <p>{{message}}</p>
          </el-alert>
        </el-col>
      </el-row>

      <el-form-item>
        <el-button
          type="primary"
          @click.prevent="onSubmit"
          :style="{width: '100%'}"
        >Add Your Recipe !</el-button>
      </el-form-item>
    </el-form>
  </el-card>
</template>

<style>
.medium-box {
  max-width: 1000px;
  margin: 0 auto;
}

.el-upload__input {
  visibility: hidden;
  position: absolute;
  left: -1000px;
}

.img-thumbnail {
  max-height: 150px;
}
</style>


<script>
import axios from "axios";
export default {
  data() {
    return {
      title: "",
      photo: "",
      ingredients: [],
      instructions: [],
      categories: [],
      cat: "",
      ingresdientsInput: "",
      instructionInput: "",
      error: false,
      message: "",
      img_upload: ""
    };
  },
  mounted() {
    this.getCategories();
  },
  methods: {
    onSubmit() {
      axios
        .post("createRecipe", {
          title: this.title,
          author: this.$auth.user().id,
          ingredients: JSON.stringify(this.ingredients),
          instructions: JSON.stringify(this.instructions),
          image: this.img_upload,
          category: this.cat
        })
        .then(data => {
          this.$router.push("/dashboard");
        })
        .catch(error => {
          console.log(error);
          this.error = true;
        });
    },
    getCategories() {
      axios
        .get("categories")
        .then(res => {
          this.categories = res.data;
        })
        .catch(e => console.log(`😡 Error: ${err}`));
    },
    selectCat(category) {
      this.cat = category;
    },
    addIngredient(ingredient) {
      ingredient.length > 0 && this.ingredients.push(ingredient);
      this.ingresdientsInput = "";
    },
    removeIngredient(i) {
      console.log(i);
      this.ingredients = this.ingredients.filter(ingredient =>
        ingredient === i ? false : true
      );
      this.instructionInput = "";
    },
    addInstruction(instruction) {
      instruction.length > 0 && this.instructions.push(instruction);
      this.instructionsInput = "";
    },
    removeInstruction(i) {
      console.log(i);
      this.instructions = this.instructions.filter(instruction =>
        instruction === i ? false : true
      );
    },
    uploadPicture(e) {
      if (e.target.files[0].size > 2100000) {
        this.message = "Sorry this image is too big";
        document.getElementById("uploadFile").value = "";
      } else if (
        e.target.files[0].type != "image/png" &&
        e.target.files[0].type != "image/jpeg" &&
        e.target.files[0].type != "image/jpg"
      ) {
        this.message = "You can only upload image type: PNG, JPG or JPEG";
        document.getElementById("uploadFile").value = "";
      } else {
        var fileReader = new FileReader();
        fileReader.readAsDataURL(e.target.files[0]);
        fileReader.onload = e => {
          this.img_upload = e.target.result;
          console.log(this.img_upload);
        };
      }
      this.message = "";
    }
  }
};
</script>
