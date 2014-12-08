<?php
/**
 * NullableBehavior
 *
 * @license http://opensource.org/licenses/MIT MIT License
 */

App::uses('ModelBehavior', 'Model');

/**
 * NullableBehavior
 */
class NullableBehavior extends ModelBehavior {

/**
 * beforeSave method
 *
 * @param Model $Model Model using this behavior
 * @param array $options Options passed from Model::save().
 * @return bool true to continue, false to abort the save
 * @see Model::save()
 */
	public function beforeSave(Model $Model, $options = array()) {
		foreach ($Model->data[$Model->alias] as $field => $value) {
			$info = $Model->schema($field);
			if ($value === '' && is_array($info) && array_key_exists('null', $info) && $info['null'] === true) {
				$Model->data[$Model->alias][$field] = null;
			}
		}
		return true;
	}

}
