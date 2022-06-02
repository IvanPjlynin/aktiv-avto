<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct accees
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Session\Session;
use Joomla\CMS\Plugin\PluginHelper;

class SppagebuilderAddonForm_builder extends SppagebuilderAddons
{
	public function render()
	{

        //CSRF
		HTMLHelper::_('jquery.token');

		$settings          = $this->addon->settings;
		$addon_id          = $this->addon->id;
		$class             = (isset($settings->class) && $settings->class) ? ' ' . $settings->class : '';
		$recipient_email   = (isset($settings->recipient_email) && $settings->recipient_email) ? $settings->recipient_email : '';
		$additional_header = (isset($settings->additional_header) && $settings->additional_header) ? $settings->additional_header : '';
		$from              = (isset($settings->from) && $settings->from) ? $settings->from : '';
		$email_template    = (isset($settings->email_template) && $settings->email_template) ? $settings->email_template : '';
		$email_subject     = (isset($settings->email_subject) && $settings->email_subject) ? $settings->email_subject : '';
		//Captcha
		$enable_captcha   = (isset($settings->enable_captcha) && $settings->enable_captcha) ? $settings->enable_captcha : '';
		$captcha_type     = (isset($settings->captcha_type) && $settings->captcha_type) ? $settings->captcha_type : 'default';
		$captcha_question = (isset($settings->captcha_question) && $settings->captcha_question) ? $settings->captcha_question : '';
		$captcha_answer   = (isset($settings->captcha_answer) && $settings->captcha_answer) ? $settings->captcha_answer : '';

		//Policy & redirect
		$enable_policy   = (isset($settings->enable_policy) && $settings->enable_policy) ? $settings->enable_policy : '';
		$policy_text     = (isset($settings->policy_text) && $settings->policy_text) ? $settings->policy_text : '';
		$enable_redirect = (isset($settings->enable_redirect) && $settings->enable_redirect) ? $settings->enable_redirect : '';
		$redirect_url    = (isset($settings->redirect_url) && $settings->redirect_url) ? $settings->redirect_url : '';

		//success & failed message
		$success_message        = (isset($settings->success_message) && $settings->success_message) ? $settings->success_message : 'Email successfully sent!';
		$failed_message         = (isset($settings->failed_message) && $settings->failed_message) ? $settings->failed_message : 'Email sent failed, fill required field and try again!';
		$required_field_message = (isset($settings->required_field_message) && $settings->required_field_message) ? $settings->required_field_message : 'Please fill the required field.';

		//Button options
		$btn_text      = (isset($settings->btn_text) && $settings->btn_text) ? $settings->btn_text : '';
		$btn_text_aria = (isset($settings->btn_text) && $settings->btn_text) ? $settings->btn_text : '';
		$btn_class     = (isset($settings->btn_type) && $settings->btn_type) ? ' sppb-btn-' . $settings->btn_type : ' sppb-btn-primary';
		$btn_class .= (isset($settings->btn_size) && $settings->btn_size) ? ' sppb-btn-' . $settings->btn_size : '';
		$btn_class .= (isset($settings->btn_shape) && $settings->btn_shape) ? ' sppb-btn-' . $settings->btn_shape : ' sppb-btn-rounded';
		$btn_class .= (isset($settings->btn_appearance) && $settings->btn_appearance) ? ' sppb-btn-' . $settings->btn_appearance : '';
		$btn_class .= (isset($settings->btn_block) && $settings->btn_block) ? ' ' . $settings->btn_block : '';
		$btn_icon          = (isset($settings->btn_icon) && $settings->btn_icon) ? $settings->btn_icon : '';
		$btn_icon_position = (isset($settings->btn_icon_position) && $settings->btn_icon_position) ? $settings->btn_icon_position : 'left';
		$btn_position      = (isset($settings->btn_position) && $settings->btn_position) ? ' ' . $settings->btn_position : ' sppb-text-left';
		$btn_custom_class  = (isset($settings->btn_class) && $settings->btn_class) ? $settings->btn_class : '';

		$icon_arr = array_filter(explode(' ', $btn_icon));

		if (count($icon_arr) === 1)
		{
			$btn_icon = 'fa ' . $btn_icon;
		}

		if ($btn_icon_position == 'left')
		{
			$btn_text = ($btn_icon) ? '<span class="' . $btn_icon . '" aria-hidden="true"></span> ' . $btn_text : $btn_text;
		}
		else
		{
			$btn_text = ($btn_icon) ? $btn_text . ' <span class="' . $btn_icon . '" aria-hidden="true"></span>' : $btn_text;
		}

		$output = '';
		$output .= '<div class="sppb-addon sppb-addon-form-builder' . $class . '">';
		$output .= '<div class="sppb-addon-content">';
		$output .= '<form class="sppb-addon-form-builder-form"' . ($enable_redirect && $redirect_url != '' ? ' data-redirect="yes" data-redirect-url="' . $redirect_url . '"' : '') . '>';

		if (isset($settings->sp_form_builder_item) && is_array($settings->sp_form_builder_item))
		{
			$increasing_addon_id = $addon_id;

			foreach ($settings->sp_form_builder_item as $item_key => $item_value)
			{
				if ($increasing_addon_id === $increasing_addon_id)
				{
					$increasing_addon_id++;
				}
				$label               = (isset($item_value->title) && $item_value->title) ? $item_value->title : '';
				$field_name          = (isset($item_value->field_name) && $item_value->field_name) ? $item_value->field_name : '';
				$field_placeholder   = (isset($item_value->field_placeholder) && $item_value->field_placeholder) ? $item_value->field_placeholder : '';
				$field_is_required   = (isset($item_value->field_is_required) && $item_value->field_is_required) ? $item_value->field_is_required : '';
				$field_required_star = (isset($item_value->field_required_star) && $item_value->field_required_star) ? $item_value->field_required_star : '';
				$is_resize           = (isset($item_value->is_resize) && $item_value->is_resize) ? $item_value->is_resize : '';
				$field_type          = (isset($item_value->field_type) && $item_value->field_type) ? $item_value->field_type : 'text';
				$item_name_id        = $field_type ? 'sppb-form-builder-field-' . $item_key : '';
				//range & number field
				$range_min   = (isset($item_value->range_min) && $item_value->range_min != '') ? $item_value->range_min : '';
				$range_max   = (isset($item_value->range_max) && $item_value->range_max) ? $item_value->range_max : '';
				$range_step  = (isset($item_value->range_step) && $item_value->range_step) ? $item_value->range_step : '';
				$number_min  = (isset($item_value->number_min) && $item_value->number_min != '') ? $item_value->number_min : '';
				$number_max  = (isset($item_value->number_max) && $item_value->number_max) ? $item_value->number_max : '';
				$number_step = (isset($item_value->number_step) && $item_value->number_step) ? $item_value->number_step : '';
				$tel_pattern = (isset($item_value->tel_pattern) && $item_value->tel_pattern) ? $item_value->tel_pattern : '';

				if ($field_type == 'radio')
				{
					$output .= '<div class="sppb-form-group ' . $item_name_id . '">';

					if ($label)
					{
						$output .= '<label>' . $label . '' . ($field_required_star && $field_is_required ? '<span class="sppb-field-required"> *</span>' : '') . '</label>';
					}
					$output .= '<div class="form-builder-radio-content">';
					$key = "sp_form_builder_inner_item_radio";

					if (isset($item_value->$key) && is_array($item_value->$key))
					{
						$inner_values = $item_value->$key;

						foreach ($inner_values as $inner_item_key => $inner_item_value)
						{
							if (isset($inner_item_value->title) && $inner_item_value->title)
							{
								$output .= '<div class="form-builder-radio-item">';
								$inner_item_id = 'form-' . $increasing_addon_id . '-radio-' . $inner_item_key;

								$is_radio_checked = (isset($inner_item_value->is_radio_checked) && $inner_item_value->is_radio_checked) ? $inner_item_value->is_radio_checked : '';

								$output .= '<input type="radio" name="form-builder-item-[' . $field_name . '' . ($field_is_required ? '*' : '') . ']" id="' . $inner_item_id . '" value="' . $inner_item_value->title . '" class="sppb-form-control"' . ($is_radio_checked ? ' checked' : '') . '' . ($field_is_required ? ' required' : '') . '>';
								$output .= '<label for="' . $inner_item_id . '" class="form-builder-radio-label">' . $inner_item_value->title . '</label>';
								$output .= '</div>'; //.form-builder-radio-item
							}
						}
					}
					$output .= '</div>'; //.form-builder-radio-content
					$output .= $field_is_required ? '<span class="sppb-form-builder-required">' . $required_field_message . '</span>' : '';

					$output .= '</div>'; //.sppb-form-group
				}
				elseif ($field_type == 'checkbox')
				{
					$output .= '<div class="sppb-form-group ' . $item_name_id . '">';

					if ($label)
					{
						$output .= '<label>' . $label . '' . ($field_required_star ? '<span class="sppb-field-required"> *</span>' : '') . '</label>';
					}
					$output .= '<div class="form-builder-checkbox-content">';
					$key = "sp_form_builder_inner_item_checkbox";

					if (isset($item_value->$key) && is_array($item_value->$key))
					{
						$inner_values = $item_value->$key;

						foreach ($inner_values as $inner_item_key => $inner_item_value)
						{
							if (isset($inner_item_value->title) && $inner_item_value->title)
							{
								$output .= '<div class="form-builder-checkbox-item">';
								$inner_item_id = 'form-' . $increasing_addon_id . '-checkbox-' . $inner_item_key;

								$is_checkbox_checked  = (isset($inner_item_value->is_checkbox_checked) && $inner_item_value->is_checkbox_checked) ? $inner_item_value->is_checkbox_checked : '';
								$checkbox_is_required = (isset($inner_item_value->checkbox_is_required) && $inner_item_value->checkbox_is_required) ? $inner_item_value->checkbox_is_required : '';
								$checkbox_field_name  = (isset($inner_item_value->checkbox_field_name) && $inner_item_value->checkbox_field_name) ? $inner_item_value->checkbox_field_name : '';

								$output .= '<input type="checkbox" name="form-builder-item-[' . $checkbox_field_name . '' . ($checkbox_is_required ? '*' : '') . ']" id="' . $inner_item_id . '" value="' . $inner_item_value->title . '" class="sppb-form-control"' . ($is_checkbox_checked ? ' checked' : '') . '' . ($checkbox_is_required ? ' required' : '') . '>';
								$output .= '<label for="' . $inner_item_id . '" class="form-builder-checkbox-label">' . $inner_item_value->title . '</label>';
								$output .= '</div>'; //.form-builder-checkbox-item
							}
						}
					}
					$output .= '</div>'; //.form-builder-checkbox-item
					$output .= $field_is_required ? '<span class="sppb-form-builder-required">' . $required_field_message . '</span>' : '';

					$output .= '</div>'; //.sppb-form-group
				}
				elseif ($field_type == 'textarea')
				{
					$output .= '<div class="sppb-form-group ' . $item_name_id . '">';

					if ($label)
					{
						$output .= '<label for="' . $item_name_id . '">' . $label . '' . ($field_required_star && $field_is_required ? '<span class="sppb-field-required"> *</span>' : '') . '</label>';
					}
					$output .= '<textarea name="form-builder-item-[' . $field_name . '' . ($field_is_required ? '*' : '') . ']" id="' . $item_name_id . '" class="sppb-form-control' . ($is_resize ? '' : ' not-resize') . '" ' . ($field_placeholder ? 'placeholder="' . $field_placeholder . '"' : '') . '' . ($field_is_required ? ' required' : '') . '></textarea>';
					$output .= $field_is_required ? '<span class="sppb-form-builder-required">' . $required_field_message . '</span>' : '';

					$output .= '</div>'; //.sppb-form-group
				}
				elseif ($field_type == 'select')
				{
					$output .= '<div class="sppb-form-group ' . $item_name_id . '">';

					if ($label)
					{
						$output .= '<label for="' . $item_name_id . '">' . $label . '' . ($field_required_star && $field_is_required ? '<span class="sppb-field-required"> *</span>' : '') . '</label>';
					}
					$key = "sp_form_builder_inner_item_select";

					if (isset($item_value->$key) && is_array($item_value->$key))
					{
						$inner_values = $item_value->$key;
						$output .= '<select class="sppb-form-control" name="form-builder-item-[' . $field_name . '' . ($field_is_required ? '*' : '') . ']" id="' . $item_name_id . '"' . ($field_is_required ? ' required' : '') . '>';
						$output .= $field_placeholder ? '<option value="">' . $field_placeholder . '</option>' : '';

						foreach ($inner_values as $inner_item_key => $inner_item_value)
						{
							if (isset($inner_item_value->title) && $inner_item_value->title)
							{
								$is_selected = (isset($inner_item_value->is_selected) && $inner_item_value->is_selected) ? $inner_item_value->is_selected : '';
								$output .= '<option value="' . $inner_item_value->title . '"' . ($is_selected ? ' selected' : '') . '>' . $inner_item_value->title . '</option>';
							}
						}
						$output .= '</select>';
						$output .= $field_is_required ? '<span class="sppb-form-builder-required">' . $required_field_message . '</span>' : '';
					}

					$output .= '</div>'; //.sppb-form-group
				}
				elseif ($field_type == 'range')
				{
					$output .= '<div class="sppb-form-group sppb-form-builder-range ' . $item_name_id . '">';

					if ($label)
					{
						$output .= '<label for="' . $item_name_id . '">' . $label . '' . ($field_required_star && $field_is_required ? '<span class="sppb-field-required"> *</span>' : '') . '</label>';
					}
					$output .= '<div class="sppb-form-builder-range-wrap">';
					$output .= '<input type="range" id="' . $item_name_id . '" name="form-builder-item-[' . $field_name . '' . ($field_is_required ? '*' : '') . ']" class="sppb-form-control"' . ($range_min != '' ? ' min="' . $range_min . '"' : '') . '' . ($range_max ? ' max="' . $range_max . '"' : '') . '' . ($range_step ? ' step="' . $range_step . '"' : '') . '' . ($field_is_required ? ' required' : '') . '>';
					$output .= '<output for="' . $item_name_id . '" class="sppb-form-builder-range-output">50</output>';
					$output .= '</div>';
					$output .= $field_is_required ? '<span class="sppb-form-builder-required">' . $required_field_message . '</span>' : '';
					$output .= '</div>'; //.sppb-form-group
				}
				elseif ($field_type == 'number')
				{
					$output .= '<div class="sppb-form-group ' . $item_name_id . '">';

					if ($label)
					{
						$output .= '<label for="' . $item_name_id . '">' . $label . '' . ($field_required_star && $field_is_required ? '<span class="sppb-field-required"> *</span>' : '') . '</label>';
					}
					$output .= '<input type="number" id="' . $item_name_id . '" name="form-builder-item-[' . $field_name . '' . ($field_is_required ? '*' : '') . ']" class="sppb-form-control"' . ($number_min != '' ? ' min="' . $number_min . '"' : '') . '' . ($number_max ? ' max="' . $number_max . '"' : '') . '' . ($number_step ? ' step="' . $number_step . '"' : '') . '' . ($field_placeholder ? ' placeholder="' . $field_placeholder . '"' : '') . '' . ($field_is_required ? ' required' : '') . '>';
					$output .= $field_is_required ? '<span class="sppb-form-builder-required">' . $required_field_message . '</span>' : '';
					$output .= '</div>'; //.sppb-form-group
				}
				else
				{
					$output .= '<div class="sppb-form-group ' . $item_name_id . '">';

					if ($label)
					{
						$output .= '<label for="' . $item_name_id . '">' . $label . '' . ($field_required_star && $field_is_required ? '<span class="sppb-field-required"> *</span>' : '') . '</label>';
					}
					$output .= '<input type="' . $field_type . '" id="' . $item_name_id . '" name="form-builder-item-[' . $field_name . '' . ($field_is_required ? '*' : '') . ']" class="sppb-form-control"' . ($field_placeholder ? ' placeholder="' . $field_placeholder . '"' : '') . '' . ($tel_pattern ? ' pattern="' . $tel_pattern . '"' : '') . '' . ($field_is_required ? ' required' : '') . '>';
					$output .= $field_is_required ? '<span class="sppb-form-builder-required">' . $required_field_message . '</span>' : '';
					$output .= '</div>'; //.sppb-form-group
				}
			} //end first foreach
		}
		//Hidden field
		$output .= '<input type="hidden" name="recipient" value="' . base64_encode($recipient_email) . '">';
		$output .= '<input type="hidden" name="from" value="' . base64_encode($from) . '">';
		$output .= '<input type="hidden" name="addon_id" value="' . $addon_id . '">';
		$output .= '<input type="hidden" name="additional_header" value="' . base64_encode($additional_header) . '">';
		$output .= '<input type="hidden" name="email_subject" value="' . base64_encode($email_subject) . '">';
		$output .= '<textarea style="display:none;" name="email_template" aria-label="Not For Read">' . base64_encode($email_template) . '</textarea>';
		$output .= '<input type="hidden" name="success_message" value="' . base64_encode($success_message) . '">';
		$output .= '<input type="hidden" name="failed_message" value="' . base64_encode($failed_message) . '">';
		//Captcha
		if ($enable_captcha && $captcha_type == 'default')
		{
			$output .= '<div class="sppb-form-group">';
			$output .= '<label for="captcha-' . $addon_id . '">' . $captcha_question . '</label>';
			$output .= '<input type="text" name="captcha_question" id="captcha-' . $addon_id . '" class="sppb-form-control" placeholder="' . $captcha_question . '" required>';
			$output .= '</div>';
		}

		if ($enable_captcha && $captcha_type == 'default')
		{
			$output .= '<input type="hidden" name="captcha_answer" value="' . md5($captcha_answer) . '">';
		}
		elseif ($enable_captcha && $captcha_type == 'gcaptcha')
		{
			PluginHelper::importPlugin('captcha', 'recaptcha');
			Factory::getApplication()->triggerEvent('onInit', ['dynamic_recaptcha_' . $addon_id]);
			$recaptcha = Factory::getApplication()->triggerEvent('onDisplay', array(null, 'dynamic_recaptcha_' . $addon_id, 'sppb-form-builder-recaptcha'));

			$output .= (isset($recaptcha[0])) ? $recaptcha[0] : '<p class="sppb-text-danger">' . Text::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_CAPTCHA_NOT_INSTALLED') . '</p>';
		}
		elseif ($enable_captcha && $captcha_type == 'igcaptcha')
		{
			PluginHelper::importPlugin('captcha', 'recaptcha_invisible');
			Factory::getApplication()->triggerEvent('onInit', ['invisible_recaptcha_' . $this->addon->id]);
			$recaptcha = Factory::getApplication()->triggerEvent('onDisplay', array(null, 'invisible_recaptcha_' . $this->addon->id, 'sppb-dynamic-recaptcha'));

			$output .= (isset($recaptcha[0])) ? $recaptcha[0] : '<p class="sppb-text-danger">' . Text::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_INVISIBLE_CAPTCHA_NOT_INSTALLED') . '</p>';
		}

		$output .= '<input type="hidden" name="captcha_type" value="' . $captcha_type . '">';
		//Policy
		if ($enable_policy)
		{
			$output .= '<div class="sppb-form-check">';
			$output .= '<input class="sppb-form-check-input" type="checkbox" name="policy" id="policy-' . $addon_id . '" aria-label="Policy Text" value="Yes" required>';
			$output .= '<label class="sppb-form-check-label" for="policy-' . $addon_id . '">' . $policy_text . '</label>';
			$output .= '<input type="hidden" value="true" name="is_policy">';
			$output .= '</div>';
		}
		//Button
		if ($btn_text)
		{
			$output .= '<div class="sppb-form-builder-btn' . $btn_position . ' ' . $btn_custom_class . '">';
			$output .= '<button type="submit" id="btn-' . $addon_id . '" class="sppb-btn' . $btn_class . '" aria-label="' . strip_tags($btn_text_aria) . '"><i class="fa" aria-hidden="true"></i>' . $btn_text . '</button>';
			$output .= '</div>'; //.sppb-form-builder-btn
		}

		$output       .= '</form>'; //.sppb-addon-form-builder-form
		$output       .= '<div style="display:none;margin-top:10px;" class="sppb-ajax-contact-status"></div>';
		$output       .= '</div>'; //.sppb-addon-content
        $output .= '</div>'; //.sppb-addon-custom-form

        return $output;
	}

	public static function getAjax()
	{

        // if cache isn't enable
		if (!Factory::getConfig()->get('caching') && !PluginHelper::getPlugin('system', 'cache'))
		{
			// Check CSRF
			Session::checkToken() or die('Restricted Access');
		}

		// include page builder page model
		require_once JPATH_BASE . '/components/com_sppagebuilder/models/page.php';

		$input  = Factory::getApplication()->input;
		$viewid = $input->get('id', 0, 'INT');

		$mail        = Factory::getMailer();
		$message     = '';
		$showcaptcha = false;
		$has_policy  = false;

		//inputs
		$inputs = $input->get('data', array(), 'ARRAY');

		$fieldNames                   = [];
		$validation                   = false;
		$isCheckbox                   = false;
		$email_body                   = '';
		$email_subject_ajax           = '';
		$additional_header_ajax       = '';
		$success_message_ajax         = '';
		$failed_message_ajax          = '';
		$frequired_field_message_ajax = '';

		foreach ($inputs as $name => $input)
		{
			if ($input['name'] == 'captcha_type')
			{
				$captcha_type = $input['value'];
			}

			if ($input['name'] == 'view_type')
			{
				$view_type        = $input['value'];
			}

			if ($input['name'] == 'addon_id')
			{
				$addon_id = $input['value'];
			}

			if ($input['name'] == 'module_id')
			{
				$module_id        = $input['value'];
			}

			if ($input['name'] == 'recipient')
			{
				$recipient = base64_decode($input['value']);
			}

			if ($input['name'] == 'from')
			{
				$from = base64_decode($input['value']);
			}

			if ($input['name'] == 'captcha_question')
			{
				$captcha_question = $input['value'];
			}

			if ($input['name'] == 'captcha_answer')
			{
				$captcha_answer = $input['value'];
				$showcaptcha    = true;
			}

			if ($input['name'] == 'g-recaptcha-response')
			{
				$gcaptcha    = $input['value'];
				$showcaptcha = true;
			}

			if ($input['name'] == 'policy')
			{
				$policy                     = $input['value'];
				$fieldNames[$input['name']] = $input['value'];
			}

			if ($input['name'] == 'is_policy')
			{
				$has_policy = true;
			}

			preg_match_all("/\[([^\]]*)\]/", $input['name'], $matches);
			$name = '';

			if (is_array($matches) && count($matches[0]) > 0)
			{
				$name       = isset($matches[1][0]) ? $matches[1][0] : $input['name'];
				$isRequired = strpos($name, "*");

				if ($isRequired)
				{
					if ($input['value'] == "")
					{
						$validation = true;
					}
					$name = str_replace('*', '', $name);
				}

				$fieldNames[$name] = $input['value'];
			}

			if ($input['name'] === 'email_template')
			{
				$email_body = base64_decode($input['value']);
			}

			if ($input['name'] === 'email_subject')
			{
				$email_subject_ajax = base64_decode($input['value']);
			}

			if ($input['name'] === 'additional_header')
			{
				$additional_header_ajax = base64_decode($input['value']);
			}

			if ($input['name'] === 'success_message')
			{
				$success_message_ajax = base64_decode($input['value']);
			}

			if ($input['name'] === 'failed_message')
			{
				$failed_message_ajax = base64_decode($input['value']);
			}
		}

		if ($validation)
		{
			$output['content']         = '<span class="sppb-text-danger">' . $failed_message_ajax . '</span>';
			$output['form_validation'] = $fieldNames;

			return json_encode($output);
		}

		if ($has_policy == true && empty($policy))
		{
			$output['content'] = '<span class="sppb-text-danger">' . $failed_message_ajax . '</span>';

			return json_encode($output);
		}

		// get addon infos
		if ($view_type == 'module')
		{
			$item_data = new stdClass();
			$page_info = self::getPageInfoById($module_id, $view_type, 'new');

			if (empty($page_info))
			{ // if old version of module
				$page_info       = self::getPageInfoById($module_id, $view_type);
				$item_data->text = json_encode(json_decode($page_info->params)->content);
			}
			else
			{ // if new version of module
				$item_data->text = $page_info->text;
			}
		}
		elseif ($view_type == 'article')
		{
			$item_data = new stdClass();
			$item_data = self::getPageInfoById($viewid, $view_type);
		}
		else
		{
			$model     = new SppagebuilderModelPage();
			$item_data = $model->getItem($viewid);
		}

		$output               = array();
		$output['status']     = false;
		$output['gcaptchaId'] = '';

		// Match has addon id
		if (self::verifyAddon($item_data->text, $addon_id) == false)
		{
			$output['content'] = '<span class="sppb-text-danger">' . $failed_message_ajax . '</span>';

			return json_encode($output);
		}

		if ($showcaptcha)
		{
			if ($captcha_type == 'gcaptcha' || $captcha_type == 'igcaptcha')
			{
				if ($gcaptcha == '')
				{
					$output['content'] = '<span class="sppb-text-danger">' . Text::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_INVALID_CAPTCHA') . '</span>';

					return json_encode($output);
				}
				else
				{
					if ($captcha_type == 'igcaptcha')
					{
						PluginHelper::importPlugin('captcha', 'recaptcha_invisible');
						$output['gcaptchaId']   = 'invisible_recaptcha_' . $addon_id;
						$output['gcaptchaType'] = 'invisible';
					}
					else
					{
						PluginHelper::importPlugin('captcha', 'recaptcha');
						$output['gcaptchaId']   = 'dynamic_recaptcha_' . $addon_id;
						$output['gcaptchaType'] = 'dynamic';
					}

					$res = Factory::getApplication()->triggerEvent('onCheckAnswer', [$gcaptcha]);
					// if module then verify gcaptcha
					if ($view_type == 'module')
					{
						$res = ($gcaptcha != null || strlen($gcaptcha) != 0) ? array(true) : array(false);
					}

					if (!$res[0])
					{
						$output['content'] = '<span class="sppb-text-danger">' . Text::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_INVALID_CAPTCHA') . '</span>';

						return json_encode($output);
					}
				}
			}
			else
			{
				if (md5($captcha_question) != $captcha_answer)
				{
					$output['content'] = '<span class="sppb-text-danger">' . Text::_('COM_SPPAGEBUILDER_ADDON_AJAX_CONTACT_WRONG_CAPTCHA') . '</span>';

					return json_encode($output);
				}
			}
		}

		$replyToMail = $replyToName = $cc = $bcc = $from_name = $from_email = '';
		// Subject Structure
		$site_name         = isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : '';

		if ($from != '')
		{
			$from = explode(':', $from);

			if (count($from) > 1)
			{
				$from_name  =  isset($from[0]) ?  trim($from[0]) : '';
				$from_email =  isset($from[1]) ?  trim($from[1]) : '';
			}
			elseif (count($from) == 1)
			{
				$from_email =  isset($from[0]) ?  trim($from[0]) : '';
				$validMail  = preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $from_email);

				if ($validMail && $from_name == '')
				{
					$from_name = $site_name;
				}
			}
		}

		$additional_header_ajax = explode("\n", $additional_header_ajax);

		foreach ($additional_header_ajax as $_header)
		{
			$_header = explode(':', $_header);

			if (count($_header) > 0)
			{
				if (strtolower($_header[0]) == 'reply-to')
				{
					$replyToMail =  isset($_header[1]) ?  trim($_header[1]) : '';
				}

				if (strtolower($_header[0])  == 'reply-name')
				{
					$replyToName =  isset($_header[1]) ?  trim($_header[1]) : '';
				}

				if (strtolower($_header[0]) == 'cc')
				{
					$cc =  isset($_header[1]) ?  trim($_header[1]) : '';
				}

				if (strtolower($_header[0]) == 'bcc')
				{
					$bcc =  isset($_header[1]) ?  trim($_header[1]) : '';
				}
			}
		}

		$output['fields'] = $fieldNames;

		foreach ($fieldNames as $name => $value)
		{
			$email_body         = str_replace("{{" . $name . "}}", $value, $email_body);
			$email_subject_ajax = str_replace("{{" . $name . "}}", $value, $email_subject_ajax);
			$replyToName        = str_replace("{{" . $name . "}}", $value, $replyToName);
			$replyToMail        = str_replace("{{" . $name . "}}", $value, $replyToMail);
			$from_name          = str_replace("{{" . $name . "}}", $value, $from_name);
			$cc                 = str_replace("{{" . $name . "}}", $value, $cc);
			$bcc                = str_replace("{{" . $name . "}}", $value, $bcc);
		}

		//get sender UP
		$senderip       = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		// $mail_subject   = $subject . ' | ' . $email . ' | ' . $site_name;
		$email_subject_ajax = str_replace("{{site-name}}", $site_name, $email_subject_ajax);

		$config = Factory::getConfig();

		$sender = array($config->get('mailfrom'), $config->get('fromname'));

		if (!empty($from_email))
		{
			$sender = array($from_email, $from_name);
			$mail->addReplyTo($replyToMail, $replyToName);
		}

		// Check cc and Bcc
		if (!empty($cc))
		{
			$mail->addCc($cc);
		}

		if (!empty($bcc))
		{
			$mail->addBcc($bcc);
		}

		if (empty($sender))
		{
			$output['content'] = '<span class="sppb-text-danger">' . Text::_('COM_SPPAGEBUILDER_ADDON_AJAX_FROM_BUILDER_SENDER_FAILED') . '</span>';

			return json_encode($output);
		}

		if (empty($recipient))
		{
			$output['content'] = '<span class="sppb-text-danger">' . Text::_('COM_SPPAGEBUILDER_ADDON_AJAX_FROM_BUILDER_RECIPIENT_FAILED') . '</span>';

			return json_encode($output);
		}

		$mail->setSender($sender);
		$mail->addRecipient($recipient);
		$mail->setSubject($email_subject_ajax);
		$mail->isHTML(true);
		$mail->Encoding = 'base64';
		$mail->setBody($email_body);

		try
		{
			if ($mail->Send())
			{
				$output['status']  = true;
				$output['content'] = '<span class="sppb-text-success">' . $success_message_ajax . '</span>';
			}
		}
		catch (\Exception $e)
		{
			$output['content'] = '<span class="sppb-text-danger">' . $e->getMessage() . '</span>';
		}

		return json_encode($output);
	}

	public static function getPageInfoById($item_id, $view_type = 'page', $version = '')
	{
		$db    = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select(array('a.*'));

		if ($view_type == 'module')
		{
			if ($version == 'new')
			{
				$query->from($db->quoteName('#__sppagebuilder', 'a'));
				$query->where($db->quoteName('a.extension_view') . " = " . $db->quote('module'));
				$query->where($db->quoteName('a.view_id') . " = " . $db->quote((int) $item_id));
			}
			else
			{
				$query->from($db->quoteName('#__modules', 'a'));
				$query->where($db->quoteName('a.id') . " = " . $db->quote((int) $item_id));
			}
		}
		elseif ($view_type == 'article')
		{
			$query->from($db->quoteName('#__sppagebuilder', 'a'));
			$query->where($db->quoteName('a.view_id') . " = " . $db->quote((int) $item_id));
		}
		else
		{
			$query->from($db->quoteName('#__sppagebuilder', 'a'));
			$query->where($db->quoteName('a.id') . " = " . $db->quote((int) $item_id));
		}
		$db->setQuery($query);
		$result = $db->loadObject();

		return $result;
	}

	public function css()
	{
		$settings    = $this->addon->settings;
		$addon_id    = '#sppb-addon-' . $this->addon->id;
		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
		$css_path    = new FileLayout('addon.css.button', $layout_path);
		$css         = '';

		if (isset($settings->sp_form_builder_item) && is_array($settings->sp_form_builder_item))
		{
			foreach ($settings->sp_form_builder_item as $item_key => $item_value)
			{
				$field_type     = (isset($item_value->field_type) && $item_value->field_type) ? $item_value->field_type : 'text';
				$item_name_id   = $field_type ? 'sppb-form-builder-field-' . $item_key : '';
				$field_width    = (isset($item_value->field_width) && $item_value->field_width) ? $item_value->field_width : '';
				$field_width_sm = (isset($item_value->field_width_sm) && $item_value->field_width_sm) ? $item_value->field_width_sm : '';
				$field_width_xs = (isset($item_value->field_width_xs) && $item_value->field_width_xs) ? $item_value->field_width_xs : '';

				if ($field_width)
				{
					$css .= $addon_id . ' .sppb-form-group.' . $item_name_id . ' { ';
					$css .= 'width:' . $field_width . '%;';
					$css .= '}';
				}

				if ($field_width_sm)
				{
					$css .= '@media (min-width: 768px) and (max-width: 991px) {';
					$css .= $addon_id . ' .sppb-form-group.' . $item_name_id . ' { ';
					$css .= 'width:' . $field_width_sm . '%;';
					$css .= '}';
					$css .= '}';
				}

				if ($field_width_xs)
				{
					$css .= '@media (max-width: 767px) {';
					$css .= $addon_id . ' .sppb-form-group.' . $item_name_id . ' { ';
					$css .= 'width:' . $field_width_xs . '%;';
					$css .= '}';
					$css .= '}';
				}
			}
		}

		//Form field spacing
		$field_gutter           = (isset($settings->field_gutter) && $settings->field_gutter) ? $settings->field_gutter : '';
		$field_horizontal_space = (isset($settings->field_horizontal_space) && $settings->field_horizontal_space) ? $settings->field_horizontal_space : '';

		if ($field_gutter)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form { ';
			$css .= 'margin-left:-' . $field_gutter . 'px;';
			$css .= 'margin-right:-' . $field_gutter . 'px;';
			$css .= '}';
			$css .= $addon_id . ' .sppb-form-check,';
			$css .= $addon_id . ' .sppb-form-builder-btn { ';
			$css .= 'margin-left:' . $field_gutter . 'px;';
			$css .= 'margin-right:' . $field_gutter . 'px;';
			$css .= '}';
			$css .= $addon_id . ' .sppb-form-builder-recaptcha,';
			$css .= $addon_id . ' .sppb-form-builder-invisible-recaptcha,';
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group { ';
			$css .= 'padding-left:' . $field_gutter . 'px;';
			$css .= 'padding-right:' . $field_gutter . 'px;';
			$css .= '}';
		}

		if ($field_horizontal_space)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group { ';
			$css .= 'margin-bottom:' . $field_horizontal_space . 'px;';
			$css .= '}';
		}

		//Form field style
		$field_style = '';
		$field_style .= (isset($settings->field_bg_color) && $settings->field_bg_color) ? 'background:' . $settings->field_bg_color . ';' : '';
		$field_style .= (isset($settings->field_color) && $settings->field_color) ? 'color:' . $settings->field_color . ';' : '';
		$field_style .= (isset($settings->field_font_size) && $settings->field_font_size) ? 'font-size:' . $settings->field_font_size . 'px;' : '';
		$field_style .= (isset($settings->field_border_width) && trim($settings->field_border_width)) ? 'border-width:' . $settings->field_border_width . ';border-style:solid;' : '';
		$field_style .= (isset($settings->field_border_color) && $settings->field_border_color) ? 'border-color:' . $settings->field_border_color . ';' : '';
		$field_style .= (isset($settings->field_border_radius) && $settings->field_border_radius != '') ? 'border-radius:' . $settings->field_border_radius . 'px;' : '';
		$field_style .= (isset($settings->field_padding) && trim($settings->field_padding)) ? 'padding:' . $settings->field_padding . ';' : '';

		$input_height = (isset($settings->input_height) && $settings->input_height) ? 'height:' . $settings->input_height . 'px;' : '';

		if ($field_style || $input_height)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group select,';
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group input:not([type="checkbox"]):not([type="radio"]) {';
			$css .= $field_style;
			$css .= $input_height;
			$css .= 'transition:.35s;';
			$css .= '}';
		}
		//Textarea
		$textarea_height = (isset($settings->textarea_height) && $settings->textarea_height) ? 'height:' . $settings->textarea_height . 'px;' : '';

		if ($field_style || $textarea_height)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group textarea {';
			$css .= $field_style;
			$css .= $textarea_height;
			$css .= 'transition:.35s;';
			$css .= '}';
		}
		//Hover field
		$field_hover_style = '';
		$field_hover_style .= (isset($settings->field_hover_bg_color) && $settings->field_hover_bg_color) ? 'background:' . $settings->field_hover_bg_color . ';' : '';
		$field_hover_style .= (isset($settings->field_focus_border_color) && $settings->field_focus_border_color) ? 'border-color:' . $settings->field_focus_border_color . ';' : '';

		if ($field_hover_style)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group input:not([type="checkbox"]):not([type="radio"]):hover,';
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group input:not([type="checkbox"]):not([type="radio"]):active,';
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group input:not([type="checkbox"]):not([type="radio"]):focus,';
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group textarea:hover,';
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group textarea:active,';
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group textarea:focus{';
			$css .= $field_hover_style;
			$css .= '}';
		}
		//Placeholder
		$field_placeholder_color = (isset($settings->field_placeholder_color) && $settings->field_placeholder_color) ? 'color:' . $settings->field_placeholder_color . ';' : '';

		if ($field_placeholder_color)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group input::placeholder,';
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group textarea::placeholder {';
			$css .= $field_placeholder_color;
			$css .= 'opacity: 1;';
			$css .= 'transition:.35s;';
			$css .= '}';
		}
		//hover placeholder
		$field_hover_placeholder_color = (isset($settings->field_hover_placeholder_color) && $settings->field_hover_placeholder_color) ? 'color:' . $settings->field_hover_placeholder_color . ';' : '';

		if ($field_hover_placeholder_color)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group input:not([type="checkbox"]):not([type="radio"]):hover::placeholder,';
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group textarea:hover::placeholder{';
			$css .= $field_hover_placeholder_color;
			$css .= 'opacity: 1;';
			$css .= '}';
		}

		//Label style
		$label_style    = '';
		$label_style_sm = '';
		$label_style_xs = '';

		$label_style .= (isset($settings->label_color) && $settings->label_color) ? 'color:' . $settings->label_color . ';' : '';
		$label_style .= (isset($settings->label_font_size) && $settings->label_font_size) ? 'font-size:' . $settings->label_font_size . 'px;' : '';
		$label_style .= (isset($settings->label_margin) && trim($settings->label_margin)) ? 'margin:' . $settings->label_margin . ';' : '';

		$label_style_sm .= (isset($settings->label_font_size_sm) && $settings->label_font_size_sm) ? 'font-size:' . $settings->label_font_size_sm . 'px;' : '';
		$label_style_sm .= (isset($settings->label_margin_sm) && trim($settings->label_margin_sm)) ? 'margin:' . $settings->label_margin_sm . ';' : '';

		$label_style_xs .= (isset($settings->label_font_size_xs) && $settings->label_font_size_xs) ? 'font-size:' . $settings->label_font_size_xs . 'px;' : '';
		$label_style_xs .= (isset($settings->label_margin_xs) && trim($settings->label_margin_xs)) ? 'margin:' . $settings->label_margin_xs . ';' : '';

		$label_font_style = (isset($settings->label_font_style) && $settings->label_font_style) ? $settings->label_font_style : '';

		if (isset($label_font_style->underline) && $label_font_style->underline)
		{
			$label_style .= 'text-decoration:underline;';
		}

		if (isset($label_font_style->italic) && $label_font_style->italic)
		{
			$label_style .= 'font-style:italic;';
		}

		if (isset($label_font_style->uppercase) && $label_font_style->uppercase)
		{
			$label_style .= 'text-transform:uppercase;';
		}

		if (isset($label_font_style->weight) && $label_font_style->weight)
		{
			$label_style .= 'font-weight:' . $label_font_style->weight . ';';
		}

		if ($label_style)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group label:not(.form-builder-radio-label):not(.form-builder-checkbox-label) {';
			$css .= $label_style;
			$css .= '}';
		}

		//Checkbox and Radio style
		$checkbox_color = (isset($settings->checkbox_color) && $settings->checkbox_color) ? $settings->checkbox_color : '';

		if ($checkbox_color)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder .sppb-form-check-label::before,';
			$css .= $addon_id . ' .form-builder-checkbox-item label::before {';
			$css .= 'border-color:' . $checkbox_color . ';';
			$css .= '}';
			$css .= $addon_id . ' .sppb-addon-form-builder .sppb-form-check-input:checked + label::before,';
			$css .= $addon_id . ' .form-builder-checkbox-item input:checked + label::before {';
			$css .= 'background:' . $checkbox_color . ';';
			$css .= '}';
		}
		$radio_color = (isset($settings->radio_color) && $settings->radio_color) ? $settings->radio_color : '';

		if ($radio_color)
		{
			$css .= $addon_id . ' .form-builder-radio-item label::before {';
			$css .= 'border-color:' . $radio_color . ';';
			$css .= '}';
			$css .= $addon_id . ' .form-builder-radio-item input:checked + label::before {';
			$css .= 'background:' . $radio_color . ';';
			$css .= '}';
		}

		//Responsive
		//Tablet
		//Form field spacing table
		$field_gutter_sm           = (isset($settings->field_gutter_sm) && $settings->field_gutter_sm) ? $settings->field_gutter_sm : '';
		$field_horizontal_space_sm = (isset($settings->field_horizontal_space_sm) && $settings->field_horizontal_space_sm) ? $settings->field_horizontal_space_sm : '';

		//Form field style table
		$field_style_sm = '';
		$field_style_sm .= (isset($settings->field_font_size_sm) && $settings->field_font_size_sm) ? 'font-size:' . $settings->field_font_size_sm . 'px;' : '';
		$field_style_sm .= (isset($settings->field_padding_sm) && trim($settings->field_padding_sm)) ? 'padding:' . $settings->field_padding_sm . ';' : '';
		$input_height_sm = (isset($settings->input_height_sm) && $settings->input_height_sm) ? 'height:' . $settings->input_height_sm . 'px;' : '';
		//Textarea
		$textarea_height_sm = (isset($settings->textarea_height_sm) && $settings->textarea_height_sm) ? 'height:' . $settings->textarea_height_sm . 'px;' : '';
		//Button Margin
		$btn_margin    = (isset($settings->btn_margin) && trim($settings->btn_margin)) ? $settings->btn_margin : '';
		$btn_margin_sm = ((isset($settings->btn_margin_sm)) && trim($settings->btn_margin_sm)) ? $settings->btn_margin_sm : '';
		$btn_margin_xs = ((isset($settings->btn_margin_xs)) && trim($settings->btn_margin_xs)) ? $settings->btn_margin_xs : '';

		if ($btn_margin)
		{
			$css .= $addon_id . ' .sppb-form-builder-btn button {';
			$css .= 'margin: ' . $btn_margin . ';';
			$css .= '}';
		}

		$css .= '@media (min-width: 768px) and (max-width: 991px) {';

		if ($field_gutter_sm)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form { ';
			$css .= 'margin-left:-' . $field_gutter_sm . 'px;';
			$css .= 'margin-right:-' . $field_gutter_sm . 'px;';
			$css .= '}';
			$css .= $addon_id . ' .sppb-form-check,';
			$css .= $addon_id . ' .sppb-form-builder-btn { ';
			$css .= 'margin-left:' . $field_gutter_sm . 'px;';
			$css .= 'margin-right:' . $field_gutter_sm . 'px;';
			$css .= '}';
			$css .= $addon_id . ' .sppb-form-builder-recaptcha,';
			$css .= $addon_id . ' .sppb-form-builder-invisible-recaptcha,';
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group { ';
			$css .= 'padding-left:' . $field_gutter_sm . 'px;';
			$css .= 'padding-right:' . $field_gutter_sm . 'px;';
			$css .= '}';
		}

		if ($field_horizontal_space_sm)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group { ';
			$css .= 'margin-bottom:' . $field_horizontal_space_sm . 'px;';
			$css .= '}';
		}

		if ($field_style_sm || $input_height_sm)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group select,';
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group input:not([type="checkbox"]):not([type="radio"]) {';
			$css .= $field_style_sm;
			$css .= $input_height_sm;
			$css .= '}';
		}

		if ($field_style_sm || $textarea_height_sm)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group textarea {';
			$css .= $field_style_sm;
			$css .= $textarea_height_sm;
			$css .= '}';
		}

		if ($label_style_sm)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group label:not(.form-builder-radio-label):not(.form-builder-checkbox-label) {';
			$css .= $label_style_sm;
			$css .= '}';
		}

		if ($btn_margin_sm)
		{
			$css .= $addon_id . ' .sppb-form-builder-btn button {';
			$css .= 'margin: ' . $btn_margin_sm . ';';
			$css .= '}';
		}
		$css .= '}';

		//Mobile
		//Form field spacing table
		$field_gutter_xs           = (isset($settings->field_gutter_xs) && $settings->field_gutter_xs) ? $settings->field_gutter_xs : '';
		$field_horizontal_space_xs = (isset($settings->field_horizontal_space_xs) && $settings->field_horizontal_space_xs) ? $settings->field_horizontal_space_xs : '';

		//Form field style table
		$field_style_xs = '';
		$field_style_xs .= (isset($settings->field_font_size_xs) && $settings->field_font_size_xs) ? 'font-size:' . $settings->field_font_size_xs . 'px;' : '';
		$field_style_xs .= (isset($settings->field_padding_xs) && trim($settings->field_padding_xs)) ? 'padding:' . $settings->field_padding_xs . ';' : '';
		$input_height_xs = (isset($settings->input_height_xs) && $settings->input_height_xs) ? 'height:' . $settings->input_height_xs . 'px;' : '';
		//Textarea
		$textarea_height_xs = (isset($settings->textarea_height_xs) && $settings->textarea_height_xs) ? 'height:' . $settings->textarea_height_xs . 'px;' : '';

		$css .= '@media (max-width: 767px) {';

		if ($field_gutter_xs)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form { ';
			$css .= 'margin-left:-' . $field_gutter_xs . 'px;';
			$css .= 'margin-right:-' . $field_gutter_xs . 'px;';
			$css .= '}';
			$css .= $addon_id . ' .sppb-form-check,';
			$css .= $addon_id . ' .sppb-form-builder-btn { ';
			$css .= 'margin-left:' . $field_gutter_xs . 'px;';
			$css .= 'margin-right:' . $field_gutter_xs . 'px;';
			$css .= '}';
			$css .= $addon_id . ' .sppb-form-builder-recaptcha,';
			$css .= $addon_id . ' .sppb-form-builder-invisible-recaptcha,';
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group { ';
			$css .= 'padding-left:' . $field_gutter_xs . 'px;';
			$css .= 'padding-right:' . $field_gutter_xs . 'px;';
			$css .= '}';
		}

		if ($field_horizontal_space_xs)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group { ';
			$css .= 'margin-bottom:' . $field_horizontal_space_xs . 'px;';
			$css .= '}';
		}

		if ($field_style_xs || $input_height_xs)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group select,';
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group input:not([type="checkbox"]):not([type="radio"]) {';
			$css .= $field_style_xs;
			$css .= $input_height_xs;
			$css .= '}';
		}

		if ($field_style_xs || $textarea_height_xs)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group textarea {';
			$css .= $field_style_xs;
			$css .= $textarea_height_xs;
			$css .= '}';
		}

		if ($label_style_xs)
		{
			$css .= $addon_id . ' .sppb-addon-form-builder-form .sppb-form-group label:not(.form-builder-radio-label):not(.form-builder-checkbox-label) {';
			$css .= $label_style_xs;
			$css .= '}';
		}

		if ($btn_margin_xs)
		{
			$css .= $addon_id . ' .sppb-form-builder-btn button {';
			$css .= 'margin: ' . $btn_margin_xs . ';';
			$css .= '}';
		}
		$css .= '}';

		//Button style
		$options                                   = new stdClass;
		$options->button_type                      = (isset($settings->btn_type) && $settings->btn_type) ? $settings->btn_type : '';
		$options->button_appearance                = (isset($settings->btn_appearance) && $settings->btn_appearance) ? $settings->btn_appearance : '';
		$options->button_color                     = (isset($settings->btn_color) && $settings->btn_color) ? $settings->btn_color : '';
		$options->button_color_hover               = (isset($settings->btn_color_hover) && $settings->btn_color_hover) ? $settings->btn_color_hover : '';
		$options->button_background_color          = (isset($settings->btn_background_color) && $settings->btn_background_color) ? $settings->btn_background_color : '';
		$options->button_background_color_hover    = (isset($settings->btn_background_color_hover) && $settings->btn_background_color_hover) ? $settings->btn_background_color_hover : '';
		$options->button_fontstyle                 = (isset($settings->btn_fontstyle) && $settings->btn_fontstyle) ? $settings->btn_fontstyle : '';
		$options->button_font_style                = (isset($settings->btn_font_style) && $settings->btn_font_style) ? $settings->btn_font_style : '';
		$options->link_button_color                = (isset($settings->link_button_color) && $settings->link_button_color) ? $settings->link_button_color : '';
		$options->link_border_color                = (isset($settings->link_border_color) && $settings->link_border_color) ? $settings->link_border_color : '';
		$options->link_button_border_width         = (isset($settings->link_button_border_width) && $settings->link_button_border_width) ? $settings->link_button_border_width : '';
		$options->link_button_padding_bottom       = (isset($settings->link_button_padding_bottom) && gettype($settings->link_button_padding_bottom) == 'string') ? $settings->link_button_padding_bottom : '';
		$options->button_padding                   = (isset($settings->btn_padding) && trim($settings->btn_padding)) ? $settings->btn_padding : '';
		$options->button_padding_sm                = (isset($settings->btn_padding_sm) && trim($settings->btn_padding_sm)) ? $settings->btn_padding_sm : '';
		$options->button_padding_xs                = (isset($settings->btn_padding_xs) && trim($settings->btn_padding_xs)) ? $settings->btn_padding_xs : '';
		$options->fontsize                         = (isset($settings->btn_fontsize) && $settings->btn_fontsize) ? $settings->btn_fontsize : '';
		$options->fontsize_sm                      = (isset($settings->btn_fontsize_sm) && $settings->btn_fontsize_sm) ? $settings->btn_fontsize_sm : '';
		$options->fontsize_xs                      = (isset($settings->btn_fontsize_xs) && $settings->btn_fontsize_xs) ? $settings->btn_fontsize_xs : '';
		$options->button_letterspace               = (isset($settings->btn_letterspace) && $settings->btn_letterspace) ? $settings->btn_letterspace : '';
		$options->button_background_gradient       = (isset($settings->btn_background_gradient) && $settings->btn_background_gradient) ? $settings->btn_background_gradient : new stdClass();
		$options->button_background_gradient_hover = (isset($settings->btn_background_gradient_hover) && $settings->btn_background_gradient_hover) ? $settings->btn_background_gradient_hover : new stdClass();

		$css .= $css_path->render(array('addon_id' => $addon_id, 'options' => $options, 'id' => 'btn-' . $this->addon->id));

		return $css;
	}

	public static function verifyAddon($pageContent, $addonId)
	{
		$addonInfo   = false;
		$pageContent = json_decode($pageContent);

		foreach ($pageContent as $key => $row)
		{
			foreach ($row->columns as $key => $column)
			{
				foreach ($column->addons as $key => $addon)
				{

                    // if direct addon
					if (($addon->id == $addonId) && ($addon->name == 'form_builder'))
					{
						return true;

						break;
					}

					// if has inner array
					if (isset($addon->columns) && count($addon->columns) && $addon->columns)
					{
						foreach ($addon->columns as $key => $inner_column)
						{
							foreach ($inner_column->addons as $key => $inner_addon)
							{
								if (($inner_addon->id == $addonId) && ($inner_addon->name == 'form_builder'))
								{
									return true;

									break;
								}
							}
						}
					} // END:: has inner columns

					// if repeatable addon (tab, accordion)
					$inner_items = 'sp_' . $addon->name . '_item';

					if (isset($addon->settings->$inner_items) && count($addon->settings->$inner_items) && $addon->settings->$inner_items)
					{
						foreach ($addon->settings->$inner_items as $inner_item)
						{
							if (isset($inner_item->content) && is_array($inner_item->content) && !empty($inner_item->content))
							{
								foreach ($inner_item->content as $inner_addon)
								{
									if (($inner_addon->id == $addonId) && ($inner_addon->name == 'form_builder'))
									{
										return true;

										break;
									}
								}
							}
						}
					} // END:: repeatable addon (tab, accordion)
				}
			}
		}

		return false;
	}

	public static function getTemplate()
	{
		$output = '
        <#
            var classList = "";
            classList += " sppb-btn-"+data.btn_type;
            classList += " sppb-btn-"+data.btn_size;
            classList += " sppb-btn-"+data.btn_shape;
            if(!_.isEmpty(data.btn_appearance)){
                classList += " sppb-btn-"+data.btn_appearance;
            }
            var modern_font_style = false;
            var btn_fontstyle = data.btn_fontstyle || "";
            var btn_font_style = data.btn_font_style || "";
        #>

        <style type="text/css">
        <# if(!_.isEmpty(data.sp_form_builder_item) && _.isArray(data.sp_form_builder_item)){
            _.each (data.sp_form_builder_item, function(item_value, item_key) {
                let field_type = (!_.isEmpty(item_value.field_type) && item_value.field_type) ? item_value.field_type : "text";
                let item_name_id = field_type ? "sppb-form-builder-field-"+item_key : "";
                if(_.isObject(item_value.field_width)){
        #>
                    #sppb-addon-{{ data.id }} .sppb-form-group.{{item_name_id}} {
                        width:{{item_value.field_width.md}}%;
                    }
                <# } else { #>
                    #sppb-addon-{{ data.id }} .sppb-form-group.{{item_name_id}} {
                        width:{{item_value.field_width}}%;
                    }
                <# }
                if(_.isObject(item_value.field_width)){
                #>
                    @media (min-width: 768px) and (max-width: 991px) {
                        #sppb-addon-{{ data.id }} .sppb-form-group.{{item_name_id}} {
                            width:{{item_value.field_width.sm}}%;
                        }
                    }
                <# }
                if(_.isObject(item_value.field_width)){
                #>
                    @media (max-width: 767px) {
                        #sppb-addon-{{ data.id }} .sppb-form-group.{{item_name_id}} {
                            width:{{item_value.field_width.xs}}%;
                        }
                    }
                <# }
            })
        } #>

        <# if(_.isObject(data.field_gutter) && data.field_gutter){ #>
            #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form {
                margin-left:-{{data.field_gutter.md}}px;
                margin-right:-{{data.field_gutter.md}}px;
            }
            #sppb-addon-{{ data.id }} .sppb-form-check,
            #sppb-addon-{{ data.id }} .sppb-form-builder-btn {
                margin-left:{{data.field_gutter.md}}px;
                margin-right:{{data.field_gutter.md}}px;
            }
            #sppb-addon-{{ data.id }} .sppb-form-builder-recaptcha,
            #sppb-addon-{{ data.id }} .sppb-form-builder-invisible-recaptcha,
            #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group {
                padding-left:{{data.field_gutter.md}}px;
                padding-right:{{data.field_gutter.md}}px;
            }
        <# }
        if(_.isObject(data.field_horizontal_space) && data.field_horizontal_space){
        #>
            #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group {
                margin-bottom:{{data.field_horizontal_space.md}}px;
            }
        <# } #>

        #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group select,
        #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group input:not([type="checkbox"]):not([type="radio"]) {
            background:{{data.field_bg_color}};
            color:{{data.field_color}};
            <# if(_.isObject(data.field_font_size)) { #>
                font-size:{{data.field_font_size.md}}px;
            <# } #>
            <# if(data.field_border_width){ #>
                border-width:{{data.field_border_width}};
                border-style:solid;
            <# } #>
            border-color:{{data.field_border_color}};
            border-radius:{{data.field_border_radius}}px;
            <# if(_.isObject(data.field_padding)){ #>
                padding:{{data.field_padding.md}};
            <# } else { #>
                padding:{{data.field_padding}};
            <# } #>
            <# if(_.isObject(data.input_height) && data.input_height) { #>
                height:{{data.input_height.md}}px;
            <# } #>
            transition:.35s;
        }

        #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group textarea {
            background:{{data.field_bg_color}};
            color:{{data.field_color}};
            <# if(_.isObject(data.field_font_size)) { #>
                font-size:{{data.field_font_size.md}}px;
            <# } #>
            <# if(data.field_border_width){ #>
                border-width:{{data.field_border_width}};
                border-style:solid;
            <# } #>
            border-color:{{data.field_border_color}};
            border-radius:{{data.field_border_radius}}px;
            <# if(_.isObject(data.field_padding)){ #>
                padding:{{data.field_padding.md}};
            <# } else { #>
                padding:{{data.field_padding}};
            <# } #>
            <# if(_.isObject(data.textarea_height)) { #>
                height:{{data.textarea_height.md}}px;
            <# } #>
            transition:.35s;
        }

        #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group input:not([type="checkbox"]):not([type="radio"]):hover,
        #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group input:not([type="checkbox"]):not([type="radio"]):active,
        #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group input:not([type="checkbox"]):not([type="radio"]):focus,
        #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group textarea:hover,
        #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group textarea:active,
        #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group textarea:focus{
            background:{{data.field_hover_bg_color}};
            border-color:{{data.field_focus_border_color}};
        }

        #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group input::placeholder,
        #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group textarea::placeholder {
            color:{{data.field_placeholder_color}};
            opacity: 1;
            transition:.35s;
        }

        #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group input:not([type="checkbox"]):not([type="radio"]):hover::placeholder,
        #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group textarea:hover::placeholder{
            color:{{data.field_hover_placeholder_color}};
            opacity: 1;
        }

        #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group label:not(.form-builder-radio-label):not(.form-builder-checkbox-label) {
            color:{{data.label_color}};
            <# if(_.isObject(data.label_font_style) && data.label_font_style.underline){ #>
                text-decoration:underline;
            <# }
            if(_.isObject(data.label_font_style) && data.label_font_style.italic){ #>
                font-style:italic;
            <# }
            if(_.isObject(data.label_font_style) && data.label_font_style.uppercase){ #>
                text-transform:uppercase;
            <# }
            if(_.isObject(data.label_font_style) && data.label_font_style.weight){ #>
                font-weight:{{data.label_font_style.weight}};
            <# }
            if(_.isObject(data.label_font_size)){ #>
                font-size:{{data.label_font_size.md}}px;
            <# } else { #>
                font-size:{{data.label_font_size}}px;
            <# }
            if(_.isObject(data.label_margin)){
            #>
                margin:{{data.label_margin.md}};
            <# } else { #>
                margin:{{data.label_margin}};
            <# } #>
        }

        <# if(data.checkbox_color){ #>
            #sppb-addon-{{ data.id }} .sppb-addon-form-builder .sppb-form-check-label::before,
            #sppb-addon-{{ data.id }} .form-builder-checkbox-item label::before {
                border-color:{{data.checkbox_color}};
            }
            #sppb-addon-{{ data.id }} .sppb-addon-form-builder .sppb-form-check-input:checked + label::before,
            #sppb-addon-{{ data.id }} .form-builder-checkbox-item input:checked + label::before {
                background:{{data.checkbox_color}};
            }
        <# }
        if(data.radio_color){
        #>
            #sppb-addon-{{ data.id }} .form-builder-radio-item label::before {
                border-color:{{data.radio_color}};
            }
            #sppb-addon-{{ data.id }} .form-builder-radio-item input:checked + label::before {
                background:{{data.radio_color}};
            }
        <# } #>
        <# if(data.btn_type == "link"){ #>
            #sppb-addon-{{ data.id }} .sppb-form-builder-btn button.sppb-btn-link{
                color: {{data.link_button_color}};
                border-color: {{data.link_border_color}};
                border-width: 0 0 {{data.link_button_border_width}}px 0;
                padding: 0 0 {{data.link_button_padding_bottom}}px 0;
                text-decoration: none;
                border-radius: 0;
            }
        <# } #>
        <# if (_.isObject(data.btn_margin)) { #>
            #sppb-addon-{{ data.id }} .sppb-form-builder-btn button {
                <# if (_.isObject(data.btn_margin)) { #>
                    margin: {{data.btn_margin.md}};
                <# } else { #>
                    margin: {{data.btn_margin}};
                <# } #>
            }
        <# } #>

        #sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-{{ data.btn_type }}{
            letter-spacing: {{ data.btn_letterspace }};
            <# if(_.isObject(btn_font_style) && btn_font_style.underline) { #>
                text-decoration: underline;
                <# modern_font_style = true #>
            <# } #>

            <# if(_.isObject(btn_font_style) && btn_font_style.italic) { #>
                font-style: italic;
                <# modern_font_style = true #>
            <# } #>

            <# if(_.isObject(btn_font_style) && btn_font_style.uppercase) { #>
                text-transform: uppercase;
                <# modern_font_style = true #>
            <# } #>

            <# if(_.isObject(btn_font_style) && btn_font_style.weight) { #>
                font-weight: {{ btn_font_style.weight }};
                <# modern_font_style = true #>
            <# } #>

            <# if(!modern_font_style) { #>
                <# if(_.isArray(btn_fontstyle)) { #>
                    <# if(btn_fontstyle.indexOf("underline") !== -1){ #>
                        text-decoration: underline;
                    <# } #>
                    <# if(btn_fontstyle.indexOf("uppercase") !== -1){ #>
                        text-transform: uppercase;
                    <# } #>
                    <# if(btn_fontstyle.indexOf("italic") !== -1){ #>
                        font-style: italic;
                    <# } #>
                    <# if(btn_fontstyle.indexOf("lighter") !== -1){ #>
                        font-weight: lighter;
                    <# } else if(btn_fontstyle.indexOf("normal") !== -1){#>
                        font-weight: normal;
                    <# } else if(btn_fontstyle.indexOf("bold") !== -1){#>
                        font-weight: bold;
                    <# } else if(btn_fontstyle.indexOf("bolder") !== -1){#>
                        font-weight: bolder;
                    <# } #>
                <# } #>
            <# } #>
        }

        <# if(data.btn_type == "custom"){ #>
            #sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
                color: {{ data.btn_color }};
                <# if(_.isObject(data.btn_fontsize)){ #>
                    font-size: {{data.btn_fontsize.md}}px;
                <# } else { #>
                    font-size: {{data.btn_fontsize}}px;
                <# }
                if(_.isObject(data.btn_padding)){ #>
                    padding: {{ data.btn_padding.md }};
                <# } else { #>
                    padding: {{ data.btn_padding }};
                <# }
                if(data.btn_appearance == "outline"){ #>
                    border-color: {{ data.btn_background_color }}
                <# } else if(data.btn_appearance == "3d"){ #>
                    border-bottom-color: {{ data.btn_background_color_hover }};
                    background-color: {{ data.btn_background_color }};
                <# } else if(data.btn_appearance == "gradient"){ #>
                    border: none;
                    <# if(typeof data.btn_background_gradient.type !== "undefined" && data.btn_background_gradient.type == "radial"){ #>
                        background-image: radial-gradient(at {{ data.btn_background_gradient.radialPos || "center center"}}, {{ data.btn_background_gradient.color }} {{ data.btn_background_gradient.pos || 0 }}%, {{ data.btn_background_gradient.color2 }} {{ data.btn_background_gradient.pos2 || 100 }}%);
                    <# } else { #>
                        background-image: linear-gradient({{ data.btn_background_gradient.deg || 0}}deg, {{ data.btn_background_gradient.color }} {{ data.btn_background_gradient.pos || 0 }}%, {{ data.btn_background_gradient.color2 }} {{ data.btn_background_gradient.pos2 || 100 }}%);
                    <# } #>
                <# } else { #>
                    background-color: {{ data.btn_background_color }};
                <# } #>
            }

            #sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom:hover{
                color: {{ data.btn_color_hover }};
                background-color: {{ data.btn_background_color_hover }};
                <# if(data.btn_appearance == "outline"){ #>
                        border-color: {{ data.btn_background_color_hover }};
                <# } else if(data.btn_appearance == "gradient"){ #>
                        <# if(typeof data.btn_background_gradient_hover.type !== "undefined" && data.btn_background_gradient_hover.type == "radial"){ #>
                                background-image: radial-gradient(at {{ data.btn_background_gradient_hover.radialPos || "center center"}}, {{ data.btn_background_gradient_hover.color }} {{ data.btn_background_gradient_hover.pos || 0 }}%, {{ data.btn_background_gradient_hover.color2 }} {{ data.btn_background_gradient_hover.pos2 || 100 }}%);
                        <# } else { #>
                                background-image: linear-gradient({{ data.btn_background_gradient_hover.deg || 0}}deg, {{ data.btn_background_gradient_hover.color }} {{ data.btn_background_gradient_hover.pos || 0 }}%, {{ data.btn_background_gradient_hover.color2 }} {{ data.btn_background_gradient_hover.pos2 || 100 }}%);
                        <# } #>
                <# } #>
            }
            @media (min-width: 768px) and (max-width: 991px) {
                #sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
                    <# if(_.isObject(data.btn_fontsize)){ #>
                        font-size: {{data.btn_fontsize.sm}}px;
                    <# }
                    if(_.isObject(data.btn_padding)){ #>
                        padding: {{ data.btn_padding.sm }};
                    <# } #>
                }
            }
            @media (max-width: 767px) {
                #sppb-addon-{{ data.id }} #btn-{{ data.id }}.sppb-btn-custom{
                    <# if(_.isObject(data.btn_fontsize)){ #>
                        font-size: {{data.btn_fontsize.xs}}px;
                    <# }
                    if(_.isObject(data.btn_padding)){ #>
                        padding: {{ data.btn_padding.xs }};
                    <# } #>
                }
            }

        <# } #>

        @media (min-width: 768px) and (max-width: 991px) {
            <# if(_.isObject(data.field_gutter)){ #>
                #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form {
                    margin-left:-{{data.field_gutter.sm}}px;
                    margin-right:-{{data.field_gutter.sm}}px;
                }
                #sppb-addon-{{ data.id }} .sppb-form-check,
                #sppb-addon-{{ data.id }} .sppb-form-builder-btn {
                    margin-left:{{data.field_gutter.sm}}px;
                    margin-right:{{data.field_gutter.sm}}px;
                }
                #sppb-addon-{{ data.id }} .sppb-form-builder-recaptcha,
                #sppb-addon-{{ data.id }} .sppb-form-builder-invisible-recaptcha,
                #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group {
                    padding-left:{{data.field_gutter.sm}}px;
                    padding-right:{{data.field_gutter.sm}}px;
                }
            <# }
            if(_.isObject(data.field_horizontal_space)){ #>
                #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group {
                    margin-bottom:{{data.field_horizontal_space.sm}}px;
                }
            <# } #>
            #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group select,
            #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group input:not([type="checkbox"]):not([type="radio"]) {
                <# if(_.isObject(data.field_font_size)){ #>
                    font-size:{{data.field_font_size.sm}}px;
                <# }
                if(_.isObject(data.field_padding)){ #>
                    padding:{{data.field_padding.sm}};
                <# } else { #>
                    padding:{{data.field_padding}};
                <# }
                if(_.isObject(data.input_height)){ #>
                    height:{{data.input_height.sm}}px;
                <# } #>
            }
            #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group textarea {
                <# if(_.isObject(data.field_font_size)){ #>
                    font-size:{{data.field_font_size.sm}}px;
                <# }
                if(_.isObject(data.field_padding)){ #>
                    padding:{{data.field_padding.sm}};
                <# } else { #>
                    padding:{{data.field_padding}};
                <# }
                if(_.isObject(data.textarea_height)){ #>
                    height:{{data.textarea_height.sm}}px;
                <# } #>
            }
            <# if (_.isObject(data.btn_margin)) { #>
                #sppb-addon-{{ data.id }} .sppb-form-builder-btn button {
                    <# if (_.isObject(data.btn_margin)) { #>
                        margin: {{data.btn_margin.sm}};
                    <# } #>
                }
            <# } #>
            #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group label:not(.form-builder-radio-label):not(.form-builder-checkbox-label) {
                <# if(_.isObject(data.label_font_size)){ #>
                    font-size:{{data.label_font_size.sm}}px;
                <# }
                if(_.isObject(data.label_margin)){
                #>
                    margin:{{data.label_margin.sm}};
                <# } #>
            }
        }

        @media (max-width: 767px) {
            <# if(_.isObject(data.field_gutter)){ #>
                #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form {
                    margin-left:-{{data.field_gutter.xs}}px;
                    margin-right:-{{data.field_gutter.xs}}px;
                }
                #sppb-addon-{{ data.id }} .sppb-form-check,
                #sppb-addon-{{ data.id }} .sppb-form-builder-btn {
                    margin-left:{{data.field_gutter.xs}}px;
                    margin-right:{{data.field_gutter.xs}}px;
                }
                #sppb-addon-{{ data.id }} .sppb-form-builder-recaptcha,
                #sppb-addon-{{ data.id }} .sppb-form-builder-invisible-recaptcha,
                #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group {
                    padding-left:{{data.field_gutter.xs}}px;
                    padding-right:{{data.field_gutter.xs}}px;
                }
            <# }
            if(_.isObject(data.field_horizontal_space)){ #>
                #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group {
                    margin-bottom:{{data.field_horizontal_space.xs}}px;
                }
            <# } #>
            #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group select,
            #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group input:not([type="checkbox"]):not([type="radio"]) {
                <# if(_.isObject(data.field_font_size)){ #>
                    font-size:{{data.field_font_size.xs}}px;
                <# }
                if(_.isObject(data.field_padding)){ #>
                    padding:{{data.field_padding.xs}};
                <# } else { #>
                    padding:{{data.field_padding}};
                <# }
                if(_.isObject(data.input_height)){ #>
                    height:{{data.input_height.xs}}px;
                <# } #>
            }
            #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group textarea {
                <# if(_.isObject(data.field_font_size)){ #>
                    font-size:{{data.field_font_size.xs}}px;
                <# }
                if(_.isObject(data.field_padding)){ #>
                    padding:{{data.field_padding.xs}};
                <# } else { #>
                    padding:{{data.field_padding}};
                <# }
                if(_.isObject(data.textarea_height)){ #>
                    height:{{data.textarea_height.xs}}px;
                <# } #>
            }
            <# if (_.isObject(data.btn_margin)) { #>
                #sppb-addon-{{ data.id }} .sppb-form-builder-btn button {
                    <# if (_.isObject(data.btn_margin)) { #>
                        margin: {{data.btn_margin.xs}};
                    <# } #>
                }
            <# } #>
            #sppb-addon-{{ data.id }} .sppb-addon-form-builder-form .sppb-form-group label:not(.form-builder-radio-label):not(.form-builder-checkbox-label) {
                <# if(_.isObject(data.label_font_size)){ #>
                    font-size:{{data.label_font_size.xs}}px;
                <# }
                if(_.isObject(data.label_margin)){
                #>
                    margin:{{data.label_margin.xs}};
                <# } #>
            }
        }
        </style>

        <#
            let required_field_message = (!_.isEmpty(data.required_field_message) && data.required_field_message) ? data.required_field_message : "Please fill the required field.";

            let enable_redirect = (typeof data.enable_redirect === "undefined" && data.enable_redirect) ? data.enable_redirect : 0;
            let redirect_url = (!_.isEmpty(data.redirect_url) && data.redirect_url) ? data.redirect_url : "";
            let redirect_url_attr = "";
            if(enable_redirect && redirect_url !== ""){
                redirect_url_attr = `data-redirect="yes" data-redirect-url="${redirect_url}"`;
            }

        #>

        <div class="sppb-addon sppb-addon-form-builder {{data.class}}">
        <div class="sppb-addon-content">
        <form class="sppb-addon-form-builder-form" {{{redirect_url_attr}}}>

            <#
            if(_.isArray(data.sp_form_builder_item) && data.sp_form_builder_item.length > 0){
                _.each (data.sp_form_builder_item, function(item_value, item_key) {
                    let label = (!_.isEmpty(item_value.title) && item_value.title) ? item_value.title : "";
                    let field_name = (!_.isEmpty(item_value.field_name) && item_value.field_name) ? item_value.field_name : "";
                    let field_placeholder = (!_.isEmpty(item_value.field_placeholder) && item_value.field_placeholder) ? item_value.field_placeholder : "";
                    let field_type = (!_.isEmpty(item_value.field_type) && item_value.field_type) ? item_value.field_type : "text";
                    let item_name_id = field_type ? "sppb-form-builder-field-"+item_key : "";
                    let starField = item_value.field_is_required ? "*" : "";

                    let range_min = (!_.isEmpty(item_value.range_min) && item_value.range_min) ? item_value.range_min : "";
                    let range_max = (!_.isEmpty(item_value.range_max) && item_value.range_max) ? item_value.range_max : "";
                    let range_step = (!_.isEmpty(item_value.range_step) && item_value.range_step) ? item_value.range_step : "";
                    let number_min = (!_.isEmpty(item_value.number_min) && item_value.number_min) ? item_value.number_min : "";
                    let number_max = (!_.isEmpty(item_value.number_max) && item_value.number_max) ? item_value.number_max : "";
                    let number_step = (!_.isEmpty(item_value.number_step) && item_value.number_step) ? item_value.number_step : "";

                    if(field_type=="radio"){
            #>
                        <div class="sppb-form-group {{item_name_id}}">

                            <# if(label){ #>
                                <label>{{label}}
                                <# if(item_value.field_required_star && item_value.field_is_required){ #>
                                    <span class="sppb-field-required"> *</span>
                                <# } #>
                                </label>
                            <# } #>

                            <div class="form-builder-radio-content">

                            <#
                            let radio_key = "sp_form_builder_inner_item_radio";
                            if(_.isArray(item_value[radio_key]) && item_value[radio_key].length > 0){
                                let inner_values = item_value[radio_key];
                                _.each (inner_values, function(inner_item_value, inner_item_key) {
                                    if(!_.isEmpty(inner_item_value.title) && inner_item_value.title){
                            #>
                                        <div class="form-builder-radio-item">
                                        <#
                                            let inner_item_id = `form-${data.id}-radio-${inner_item_key}`;
                                        #>
                                            <input type="radio" name="form-builder-item-[{{field_name}}{{starField}}]" id="{{inner_item_id}}" value="{{inner_item_value.title}}" class="sppb-form-control"
                                            <# if(inner_item_value.is_radio_checked){ #>
                                                checked
                                            <# } #>
                                            >
                                            <label for="{{inner_item_id}}" class="form-builder-radio-label">{{inner_item_value.title}}</label>
                                        </div>
                                    <# }
                                })
                            } #>
                            </div>

                            <# if(item_value.field_is_required){ #>
                                <span class="sppb-form-builder-required">{{required_field_message}}</span>
                            <# } #>

                        </div>
                    <# } else if(field_type=="checkbox"){ #>
                        <div class="sppb-form-group {{item_name_id}}">

                            <# if(label){ #>
                                <label>{{label}}
                                <# if(item_value.field_required_star){ #>
                                    <span class="sppb-field-required"> *</span>
                                <# } #>
                                </label>
                            <# } #>
                            <div class="form-builder-checkbox-content">
                            <#
                            let checkboxKey = "sp_form_builder_inner_item_checkbox";
                            if(_.isArray(item_value[checkboxKey]) && item_value[checkboxKey].length > 0){
                                let inner_values = item_value[checkboxKey];
                                _.each (inner_values, function(inner_item_value, inner_item_key) {
                                    if(!_.isEmpty(inner_item_value.title) && inner_item_value.title){
                            #>
                                        <div class="form-builder-checkbox-item">
                                        <#
                                            let inner_item_id = `form-${data.id}-checkbox-${inner_item_key}`;
                                        #>

                                            <input type="checkbox" name="form-builder-item-[{{inner_item_value.checkbox_field_name}}]" id="{{inner_item_id}}" value="{{inner_item_value.title}}" class="sppb-form-control"
                                            <# if(inner_item_value.is_checkbox_checked){ #>
                                                checked
                                            <# } #>
                                            >
                                            <label for="{{inner_item_id}}" class="form-builder-checkbox-label">{{inner_item_value.title}}</label>
                                        </div>
                                    <# }
                                })
                            } #>

                            </div>

                            <# if(item_value.field_is_required){ #>
                                <span class="sppb-form-builder-required">{{required_field_message}}</span>
                            <# } #>

                        </div>
                    <# } else if(field_type=="textarea"){ #>
                        <div class="sppb-form-group {{item_name_id}}">
                            <# if(label){ #>
                                <label>{{label}}
                                <# if(item_value.field_required_star && item_value.field_is_required){ #>
                                    <span class="sppb-field-required"> *</span>
                                <# } #>
                                </label>
                            <# } #>

                            <textarea name="form-builder-item-[{{field_name}}]" class="sppb-form-control <# if(item_value.is_resize === 0){ #>not-resize<# } #>" placeholder="{{field_placeholder}}" ></textarea>
                            <# if(item_value.field_is_required){ #>
                                <span class="sppb-form-builder-required">{{required_field_message}}</span>
                            <# } #>

                        </div>
                    <# } else if(field_type=="select"){ #>
                        <div class="sppb-form-group {{item_name_id}}">

                           <# if(label){ #>
                                <label>{{label}}
                                <# if(item_value.field_required_star && item_value.field_is_required){ #>
                                    <span class="sppb-field-required"> *</span>
                                <# } #>
                                </label>
                            <# } #>

                            <#
                            let selctKey = "sp_form_builder_inner_item_select";
                            if(_.isArray(item_value[selctKey]) && item_value[selctKey].length > 0){
                                let inner_values = item_value[selctKey];
                            #>
                                <select class="sppb-form-control" name="form-builder-item-[{{field_name}}]">
                            <#
                                if(field_placeholder){
                            #>
                                 <option value="">{{field_placeholder}}</option>
                            <#  }
                                _.each (inner_values, function(inner_item_value, inner_item_key) {
                                    if(!_.isEmpty(inner_item_value.title) && inner_item_value.title){
                            #>
                                            <option value="{{inner_item_value.title}}"
                                            <# if(inner_item_value.is_selected){ #>
                                                selected
                                            <# } #>
                                            >{{inner_item_value.title}}</option>
                                    <# }
                                }) #>
                                </select>
                                <# if(item_value.field_is_required){ #>
                                <span class="sppb-form-builder-required">{{required_field_message}}</span>
                            <# }
                            } #>

                        </div>
                    <# } else if(field_type=="range"){ #>
                        <div class="sppb-form-group {{item_name_id}}">
                            <# if(label){ #>
                                <label>{{label}}
                                <# if(item_value.field_required_star && item_value.field_is_required){ #>
                                    <span class="sppb-field-required"> *</span>
                                <# } #>
                                </label>
                            <# } #>

                            <input type="range" id="{{item_name_id}}" name="form-builder-item-[{{field_name}}]" class="sppb-form-control" min="{{range_min}}" max="{{range_max}}" step="{{range_step}}">
                            <# if(item_value.field_is_required){ #>
                                <span class="sppb-form-builder-required">{{required_field_message}}</span>
                            <# } #>
                        </div>
                    <# } else if(field_type=="number"){ #>
                        <div class="sppb-form-group {{item_name_id}}">
                            <# if(label){ #>
                                <label>{{label}}
                                <# if(item_value.field_required_star && item_value.field_is_required){ #>
                                    <span class="sppb-field-required"> *</span>
                                <# } #>
                                </label>
                            <# } #>

                            <input type="number" id="{{item_name_id}}" name="form-builder-item-[{{field_name}}]" class="sppb-form-control" min="{{number_min}}" max="{{number_max}}" step="{{number_step}}"  placeholder="{{field_placeholder}}">
                            <# if(item_value.field_is_required){ #>
                                <span class="sppb-form-builder-required">{{required_field_message}}</span>
                            <# } #>
                        </div>
                    <# } else if(field_type=="phone"){ #>
                        <div class="sppb-form-group {{item_name_id}}">
                            <# if(label){ #>
                                <label>{{label}}
                                <# if(item_value.field_required_star && item_value.field_is_required){ #>
                                    <span class="sppb-field-required"> *</span>
                                <# } #>
                                </label>
                            <# } #>

                            <input type="text" id="{{item_name_id}}" name="form-builder-item-[{{field_name}}]" class="sppb-form-control" placeholder="{{field_placeholder}}">
                            <# if(item_value.field_is_required){ #>
                                <span class="sppb-form-builder-required">{{required_field_message}}</span>
                            <# } #>
                        </div>
                    <# } else { #>
                        <div class="sppb-form-group {{item_name_id}}">
                            <# if(label){ #>
                                <label>{{label}}
                                <# if(item_value.field_required_star && item_value.field_is_required){ #>
                                    <span class="sppb-field-required"> *</span>
                                <# } #>
                                </label>
                            <# } #>

                            <input type="{{field_type}}" id="{{item_name_id}}" name="form-builder-item-[{{field_name}}]" class="sppb-form-control" placeholder="{{field_placeholder}}">
                            <# if(item_value.field_is_required){ #>
                                <span class="sppb-form-builder-required">{{required_field_message}}</span>
                            <# } #>
                        </div>
                    <# }

                })
            } #>

            <# if (data.enable_captcha && data.captcha_type == "default") { #>
                <div class="sppb-form-group">
                    <label>{{data.captcha_question}}</label>
                    <input type="text" name="data.captcha_question" class="sppb-form-control" placeholder="{{data.captcha_question}}">
                </div>
            <# }
            if (data.enable_captcha && data.captcha_type == "default") {
            #>
                <input type="hidden" name="captcha_answer" value="{{data.captcha_answer}}">

            <# } else if (data.enable_captcha && data.captcha_type == "gcaptcha") { #>
                <div class="sppb-form-builder-recaptcha">
                    <img src="components/com_sppagebuilder/assets/images/captcha.png" >
                </div>
            <# } else if (data.enable_captcha && data.captcha_type == "igcaptcha") { #>
                <div class="sppb-form-builder-recaptcha">
                    <img src="components/com_sppagebuilder/assets/images/captcha-2.png" >
                </div>
            <# } #>

            <# if (data.enable_policy) { #>
                <div class="sppb-form-check">
                    <input class="sppb-form-check-input" type="checkbox" name="policy" id="policy-{{data.id}}" value="Yes">
                    <label class="sppb-form-check-label" for="policy-{{data.id}}">{{{data.policy_text}}}</label>
                </div>
            <# }
                let iconLeft = "";
                let iconRight = "";

                let icon_arr = (typeof data.btn_icon !== "undefined" && data.btn_icon) ? data.btn_icon.split(" ") : "";
                let icon_name = icon_arr.length === 1 ? "fa "+data.btn_icon : data.btn_icon;

                if(data.btn_icon_position == "left" && !_.isEmpty(data.btn_icon)){
                    iconLeft = \'<span class="\' + icon_name + \'"></span>\';
                } else {
                    iconRight = \'<span class="\' + icon_name + \'"></span>\';
                }
            if(data.btn_text){
            #>
                <div class="sppb-form-builder-btn {{data.btn_position}} {{data.btn_class}}">
                    <button type="button" id="btn-{{ data.id }}" class="sppb-btn {{classList}}">{{{iconLeft}}} {{ data.btn_text }} {{{iconRight}}}</button>
                </div>
            <# } #>

        </form>
        </div>
        </div>';

		return $output;
	}
}
