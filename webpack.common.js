const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
  entry: {
    editor: ["./assets/scripts/editor.js", "./assets/styles/editor.scss"],
    main: ["./assets/scripts/main.js", "./assets/styles/main.scss"],
    "product-slider": ["./assets/scripts/product-slider.js"],
    accordion: ["./assets/scripts/accordion.js"],
    "animated-hero": ["./assets/scripts/animated-hero.js"],
    dealers: ["./assets/scripts/dealers.js"],
    checkout: ["./assets/scripts/checkout.js"],
  },
  externals: {
    jquery: "jQuery",
  },
  output: {
    filename: "scripts/[name].js",
    path: path.resolve(__dirname, "dist"),
  },
  resolve: {
    alias: {
      react: "preact/compat",
      "react-dom/test-utils": "preact/test-utils",
      "react-dom": "preact/compat",
      "react/jsx-runtime": "preact/jsx-runtime",
    },
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
        },
      },
      {
        test: /\.(sass|scss|css)$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
            options: {
              publicPath: "../",
            },
          },
          {
            loader: "css-loader",
          },
          {
            loader: "postcss-loader",
          },
          {
            loader: "resolve-url-loader",
          },
          {
            loader: "sass-loader",
          },
        ],
      },
      {
        test: /\.(jpg|png|gif)([\?]?.*)$/,
        use: [
          {
            loader: "file-loader",
            options: {
              name: () =>
                process.env.NODE_ENV === "production"
                  ? "[name].[contentHash].[ext]"
                  : "[name].[ext]",
            },
          },
        ],
      },
      {
        test: /\.svg$/,
        loader: "svg-inline-loader",
      },
      {
        test: /\.(eot|woff|woff2|ttf)([\?]?.*)$/,
        use: [
          {
            loader: "file-loader",
            options: {
              name: () =>
                process.env.NODE_ENV === "production"
                  ? "[name].[contentHash].[ext]"
                  : "[name].[ext]",
            },
          },
        ],
      },
      {
        test: /\.(mp4)([\?]?.*)$/,
        use: [
          {
            loader: "file-loader",
            options: {
              name: () =>
                process.env.NODE_ENV === "production"
                  ? "[name].[contentHash].[ext]"
                  : "[name].[ext]",
            },
          },
        ],
      },
    ],
  },
};
