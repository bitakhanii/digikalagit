import videojs from 'video.js';
import QualityLevelList from './quality-level-list.js';
import {version as VERSION} from '../package.json';

/**
 * Initialization function for the qualityLevels plugin. Sets up the QualityLevelList and
 * event handlers.
 *
 * @param {Player} player Player object.
 * @param {Object} options Plugin options object.
 * @return {QualityLevelList} a list of QualityLevels
 */
const initPlugin = function(player, options) {
  const originalPluginFn = player.qualityLevels;

  const qualityLevelList = new QualityLevelList();

  const disposeHandler = function() {
    qualityLevelList.dispose();
    player.qualityLevels = originalPluginFn;
    player.off('dispose', disposeHandler);
  };

  player.on('dispose', disposeHandler);

  player.qualityLevels = () => qualityLevelList;
  player.qualityLevels.VERSION = VERSION;

  return qualityLevelList;
};

/**
 * A video.js plugin.
 *
 * In the plugin function, the value of `this` is a video.js `Player`
 * instance. You cannot rely on the player being in a "ready" state here,
 * depending on how the plugin is invoked. This may or may not be important
 * to you; if not, remove the wait for "ready"!
 *
 * @param {Object} options Plugin options object
 * @return {QualityLevelList} a list of QualityLevels
 */
const qualityLevels = function(options) {
  return initPlugin(this, videojs.obj.merge({}, options));
};

// Register the plugin with video.js.
videojs.registerPlugin('qualityLevels', qualityLevels);

// Include the version number.
qualityLevels.VERSION = VERSION;

export default qualityLevels;
