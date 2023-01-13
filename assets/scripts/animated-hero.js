import Lottie from "lottie-web/build/player/lottie_light.min.js";
import heroAnim_json from "../lottie/hero/data.json";

(function ($) {
  function initAnimatedHero(hero, isAdmin = false) {
    const container = hero.querySelector("#hero");
    const { jsonPath } = container.dataset;
    const assetsPath = jsonPath.replace(/data\.json/, "images/");

    const animationParams = {
      name: "Hero animation",
      container,
      renderer: "svg",
      loop: true,
      autoplay: !isAdmin,
      animationData: heroAnim_json,
      assetsPath,
      rendererSettings: {
        progressiveLoad: true,
        preserveAspectRatio: "xMidYMax slice",
      },
    };

    Lottie.loadAnimation(animationParams);
  }

  if (typeof window.acf !== "undefined") {
    window.acf.addAction("render_block_preview/type=animated-hero", (preview) =>
      initAnimatedHero($(preview).find(".animated-hero").get(0), true)
    );
  } else {
    $(".animated-hero").each((index, section) => initAnimatedHero(section));
  }
})(jQuery);
