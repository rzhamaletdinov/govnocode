<?php
		/**
		* Надо было обновить два поля в юзере
		*/
		
		private function _update_level_loose_stamp($user)
		{
			$new_level = lib::$level->get($this->level_id);
			if($new_level->type != level_item::TYPE_USUAL)
				return $user;

			$current_loose_id 	= $user->settings->level_loose_id;
			$current_loose_stamp = $user->settings->level_loose_stamp;
				
			//for id > dot_id
			if($user->level_id >= $new_level->id)
			{
				if(!$user->level_id)
					return $user;
				$user_level = lib::$level->get($user->level_id);
				if($user_level->dot_id >= $new_level->dot_id)
					return $user;
				if($user_level->dot_id < $new_level->dot_id);
				{
					$user->settings->level_loose_stamp = date::timestamp();
					$user->settings->level_loose_id = $new_level->id;
				}
				return $user;
			}

			if($user->level_id >= $new_level->id)
				return $user;

			if(!$current_loose_id)
			{
				$user->settings->level_loose_stamp = date::timestamp();
				$user->settings->level_loose_id = $new_level->id;
				return $user;
			}
			
			$current_level = lib::$level->get($current_loose_id);
				
			if($current_level->dot_id >= $new_level->dot_id)
				return $user;
				
			$user->settings->level_loose_stamp = date::timestamp();
			$user->settings->level_loose_id = $new_level->id;
		
			return $user;
		}
?>