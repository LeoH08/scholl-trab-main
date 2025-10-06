(function () {
  const slider = document.querySelector(".slider");
  if (!slider) return;
  const track = slider.querySelector(".slider-track");
  const slides = Array.from(slider.querySelectorAll(".slide"));
  const btnPrev = slider.querySelector(".prev"); // agora possivelmente null
  const btnNext = slider.querySelector(".next");
  const dotsWrap = slider.querySelector(".dots");
  let index = 0;
  let auto;

  function update() {
    track.style.transform = `translateX(-${index * 100}%)`;
    dotsWrap.querySelectorAll("button").forEach((b, i) => {
      b.setAttribute("aria-current", i === index);
    });
  }

  function go(to) {
    index = (to + slides.length) % slides.length;
    update();
  }

  function buildDots() {
    slides.forEach((_, i) => {
      const bt = document.createElement("button");
      bt.type = "button";
      bt.setAttribute("aria-label", "Ir para item " + (i + 1));
      bt.addEventListener("click", () => {
        go(i);
        restart();
      });
      dotsWrap.appendChild(bt);
    });
  }

  function next() {
    go(index + 1);
  }
  function prev() {
    go(index - 1);
  }
  function start() {
    auto = setInterval(next, 3000);
  }
  function stop() {
    clearInterval(auto);
  }
  function restart() {
    stop();
    start();
  }

  buildDots();
  update();
  start();

  if (btnNext)
    btnNext.addEventListener("click", () => {
      next();
      restart();
    });
  if (btnPrev)
    btnPrev.addEventListener("click", () => {
      prev();
      restart();
    });

  slider.addEventListener("pointerenter", stop);
  slider.addEventListener("pointerleave", start);

  // Acessibilidade teclado
  slider.addEventListener("keydown", (e) => {
    if (e.key === "ArrowRight") {
      next();
      restart();
    }
    if (e.key === "ArrowLeft") {
      prev();
      restart();
    }
  });
})();
