<script setup>
import { onMounted, ref } from 'vue';

const canvasRef = ref(null);

// Imágenes
const croissantImg = new Image();
croissantImg.src = '/img/croissant-svgrepo-com.svg';
const teaImg = new Image();
teaImg.src = '/img/tea-cup-svgrepo-com.svg';

// Arreglos
const croissants = [];
const breads = [];

class Croissant {
  constructor() {
    this.x = Math.random() * canvasRef.value.width;
    this.y = -100;
    this.size = Math.random() * 40 + 30;
    this.speed = Math.random() * 2 + 1;
  }
  draw(ctx) {
    ctx.drawImage(croissantImg, this.x, this.y, this.size, this.size);
  }
  update() {
    this.y += this.speed;
    if (this.y > canvasRef.value.height) {
      this.y = -100;
      this.x = Math.random() * canvasRef.value.width;
    }
  }
}

class Bread {
  constructor() {
    this.x = Math.random() * canvasRef.value.width;
    this.y = -100;
    this.size = Math.random() * 40 + 30;
    this.speed = Math.random() * 2 + 1;
  }
  draw(ctx) {
    ctx.drawImage(teaImg, this.x, this.y, this.size, this.size);
  }
  update() {
    this.y += this.speed;
    if (this.y > canvasRef.value.height) {
      this.y = -100;
      this.x = Math.random() * canvasRef.value.width;
    }
  }
}

const createAnimation = () => {
  const canvas = canvasRef.value;
  const ctx = canvas.getContext('2d');
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  const generateItems = (arr, Class, count) => {
    for (let i = 0; i < count; i++) arr.push(new Class());
  };

  generateItems(croissants, Croissant, 8);
  generateItems(breads, Bread, 8);

  const animate = () => {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    croissants.forEach(item => { item.update(); item.draw(ctx); });
    breads.forEach(item => { item.update(); item.draw(ctx); });
    requestAnimationFrame(animate);
  };
  animate();
};

onMounted(() => {
  croissantImg.onload = () => {
    teaImg.onload = () => createAnimation();
  };
});
</script>

<template>
  <div class="relative h-screen w-screen overflow-hidden">
    <canvas ref="canvasRef" class="absolute top-0 left-0 w-full h-full"></canvas>
  </div>
</template>
