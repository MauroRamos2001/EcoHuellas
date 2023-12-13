const navItems = document.querySelector(".nav__items");
const openNavBtn = document.querySelector("#open__nav-btn");
const closeNavBtn = document.querySelector("#close__nav-btn");

// Abrir nav desplegable
const openNav = () => {
  navItems.style.display = "flex";
  openNavBtn.style.display = "none";
  closeNavBtn.style.display = "inline-block";
};

// Cerrar nav desplegable
const closeNav = () => {
  navItems.style.display = "none";
  openNavBtn.style.display = "inline-block";
  closeNavBtn.style.display = "none";
};

openNavBtn.addEventListener("click", openNav);
closeNavBtn.addEventListener("click", closeNav);

const siderbar = document.querySelector("aside");
const showSiderbarBtn = document.querySelector("#show__sidebar-btn");
const hideSiderbarBtn = document.querySelector("#hide__sidebar-btn");

// Muestra el boton de desplazamiento hacia la izquierda y derecha en pantalla pequeña
const showSiderbr = () => {
  siderbar.style.left = "0";
  showSiderbarBtn.style.display = "none";
  hideSiderbarBtn.style.display = "inline-block";
};

// Muestra el boton de desplazamiento hacia la izquierda y derecha en pantalla pequeña
const hideSidebar = () => {
  siderbar.style.left = "-100%";
  showSiderbarBtn.style.display = "inline-block";
  hideSiderbarBtn.style.display = "none";
};

showSiderbarBtn.addEventListener("click", showSiderbr);

hideSiderbarBtn.addEventListener("click", hideSidebar);
