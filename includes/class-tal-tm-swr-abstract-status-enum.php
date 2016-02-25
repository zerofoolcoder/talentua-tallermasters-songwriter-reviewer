<?php
	abstract class Tal_Tm_Swr_Abstract_Status_Enum {
		const Accepted = "accepted";
		const Rejected = "rejected";
		const StandBy = "standby";
//		const Unreviewed = "";

		public static function enum() {
	        $reflect = new ReflectionClass(get_class());
	        return $reflect->getConstants();
    	}
	}
