/**
 * Custom block styles
 */
wp.domReady(() => {
  // Typography
  wp.blocks.registerBlockStyle("core/heading", {
    name: "plain",
    label: "Plain",
  });

  wp.blocks.registerBlockStyle("core/heading", {
    name: "outline",
    label: "Outline",
  });

  wp.blocks.registerBlockStyle("core/heading", {
    name: "no-uppercase",
    label: "No uppercase",
  });

  for (const n of [1, 2, 3, 4, 5, 6]) {
    wp.blocks.registerBlockStyle("core/heading", {
      name: `h${n}`,
      label: `H${n} Size`,
    });

    wp.blocks.registerBlockStyle("core/paragraph", {
      name: `h${n}`,
      label: `H${n} Size`,
    });
  }

  // Buttons
  wp.blocks.registerBlockStyle("core/button", [
    {
      name: "fill-rounded",
      label: "Fill (Rounded)",
    },
    {
      name: "outline-rounded",
      label: "Outline (Rounded)",
    },
  ]);

  wp.blocks.registerBlockVariation("core/buttons", [
    {
      name: "uppercase",
      title: "Uppercase Buttons",
      scope: ["block", "inserter", "transform"],
      attributes: {
        className: "is-uppercase",
      },
    },
    {
      name: "bold",
      title: "Bold Buttons",
      scope: ["block", "inserter", "transform"],
      attributes: {
        className: "is-bold",
      },
    },
    {
      name: "lg",
      title: "Large Buttons",
      scope: ["block", "inserter", "transform"],
      attributes: {
        className: "is-lg",
      },
    },
    {
      name: "sm",
      title: "Small Buttons",
      scope: ["block", "inserter", "transform"],
      attributes: {
        className: "is-sm",
      },
    },
  ]);

  // Lead
  wp.blocks.registerBlockStyle("core/paragraph", [
    {
      name: "lead",
      label: "Lead",
    },
  ]);

  // Image
  wp.blocks.registerBlockStyle("core/image", [
    {
      name: "with-play-button",
      label: "With Play Button",
    },
  ]);

  // Building Blocks - Section
  wp.blocks.registerBlockStyle("building-blocks/section", [
    {
      name: "wave-bg",
      label: "Wave Background",
    },
  ]);
});
