# Blank Gulp/Jade/Compass/Sass Template WordPress Theme

### Description

This theme is aimed at web professionials, but is of course available for anyone.

The bare essentials of a WordPress theme, no CSS styles added. Perfect for those who would like to build their own theme from scratch. One custom menu and one widgetized sidebar to get you started.

Based on the BlankSlate theme by TidyThemes, Blank Gulp/Jade/Compass/Sass Template provides built-in support for building sites with Gulp, Jade, Compass, and Sass. Before using this theme, run 'npm install' in the theme's directory in order to install the gulpfile's dependencies. (See package.json for details.)

### Installation

Installation requires _npm_ and _bower_. If necessary, please install these first.

First (or then), install the back-end dependencies (gulp, etc.):

```bash
sudo npm install
```

Finally, install the front-end dependencies:

```bash
bower install
```

#### gulp-compass fix

As of the present version, Compass has an issue with Gulp where it unnecessarily recreates unmodified sprites, potentially increasing compiling time by agonizing seconds.

Replace the compass.js file in the installed gulp-compass module folder (this should be located in your _node_modules_ directory after running _sudo npm install_) with the one included in this project to prevent gulp-compass from recreating sprites every time it compiles.

### License

GNU General Public License  | http://www.gnu.org/licenses/gpl.html

Blank Gulp/Jade/Compass/Sass Template, like BlankSlate, is 100% free and open source;  perfect to build your own themes or use as a base for client projects. You may share this or list this theme anywhere as long as credit is given.