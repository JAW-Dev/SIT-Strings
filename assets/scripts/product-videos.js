window.addEventListener("DOMContentLoaded", (e) => {
  if (
    document.readyState == "interactive" ||
    document.readyState == "complete"
  ) {
    initProductVideos();
  }
});

function initProductVideos() {
  // check if the container even exists
  const productVideoContainer = document.querySelector(
    ".product-video-container"
  );

  // if not, bail
  if (!productVideoContainer) {
    return;
  }

  function showProductVideoModal(el) {
    // show the modal container and the target element
    el.classList.add("show");
    productVideoContainer.classList.add("show");

    // prevent scroll
    document.body.classList.add("noscroll");
    document.documentElement.classList.add("noscroll");
  }

  function closeProductVideoModal() {
    // simple solution to stop videos from playing regardless of where they come from
    // destroy the element and rebuild it
    productVideos.forEach((pv) => {
      if (pv.classList.contains("show")) {
        const clone = pv.cloneNode(true);
        pv.innerHTML = "";
        pv.innerHTML = clone.innerHTML;
        pv.classList.remove("show");

        // destroy the cloned element; maybe useless but better to be sure
        clone.remove();
      }
    });

    // hide the modal container and allow scroll again
    productVideoContainer.classList.remove("show");
    document.body.classList.remove("noscroll");
    document.documentElement.classList.remove("noscroll");
  }

  const productVideoClose = productVideoContainer.querySelector(
    ".close-product-video"
  );
  const galleryWrapper = document.querySelector(
    ".woocommerce-product-gallery__wrapper"
  );

  const productVideos =
    productVideoContainer.querySelectorAll(".product-video");

  productVideoContainer.addEventListener("click", (e) => {
    // close video if user clicks close button or container background
    if (e.target != productVideoContainer && e.target != productVideoClose) {
      return;
    }

    closeProductVideoModal();
  });

  productVideos.forEach((pv) => {
    // get thumbnail url
    const thumbnailUrl = pv.dataset.thumb;

    // create thumbnail element to drop into wc product gallery
    const thumbnailWrap = document.createElement("div");
    thumbnailWrap.classList.add(
      "woocommerce-product-gallery__image",
      "product-video-thumb"
    );
    // create button trigger and thumbnail image
    const button = document.createElement("button");

    const thumb = document.createElement("img");
    thumb.src = thumbnailUrl;

    button.addEventListener("click", () => {
      showProductVideoModal(pv);
    });

    // append the thumbnail to the button and the button to the thumbnail el
    button.append(thumb);
    thumbnailWrap.append(button);

    // finally add thumbnail to gallery
    galleryWrapper.append(thumbnailWrap);
  });
}
