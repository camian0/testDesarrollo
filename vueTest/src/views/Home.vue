<template>
  <h1>Inicio</h1>

  <p>
    Aqui encontraras los productos que necesitas, con los mejores precios del
    mercado, preguntenos por lo que no vea.
  </p>

  <div id="image-banner">
    <el-image
      style="height: 650px"
      src="https://www.elfinancierocr.com/resizer/Ftg8rai_Aew71GX16LsyTBMjECA=/1440x0/filters:format(jpg):quality(70)/cloudfront-us-east-1.images.arcpublishing.com/gruponacion/SBCJBG5V2VFJPA33CM2CQGKD3U.jpg"
      fit="scale-down"
    />
  </div>

  <section class="">
    <h2>Bienvenido</h2>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia maxime
      tempora non praesentium facere eius dolores eaque velit cumque asperiores!
      Blanditiis dignissimos molestias dolore sequi, odio animi quis iure qui
      laborum esse ullam repudiandae recusandae quisquam vitae minima ipsa in
      culpa beatae illo saepe incidunt ducimus perferendis asperiores. Ea,
      tenetur.
    </p>
  </section>
</template>

<script>
export default {
  name: "Home",
  setup() {
    return {};
  },
  components: {},
};
</script>

<style scoped>
h1 {
  text-align: center;
}

h2 {
  text-align: center;
}
#image-banner {
  padding: 30px 0;
  text-align: center;
  width: 95%;
  box-sizing: border-box;
  vertical-align: top;
}
main {
  margin: 5px 10px;
}
</style>
