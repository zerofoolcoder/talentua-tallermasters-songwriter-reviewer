<?php
	//UNNECESSARY:10 Change the value of each const to reflect the actual name of the class in order to test spl_autoload function

	abstract class Tal_Tm_Swr_Abstract_Factory_Items_Enum {
		const Item = "class-tal-tm-swr-item.php";
		const Collection = "class-tal-tm-swr-collection.php";
		const Casting = "class-tal-tm-swr-casting.php";
		const Candidate = "class-tal-tm-swr-candidate.php";
		const Form = "class-tal-tm-swr-form.php";
		const Forms = "class-tal-tm-swr-forms.php";
		const Candidates = "class-tal-tm-swr-candidates.php";
		const File_Upload = "class-tal-tm-swr-file-upload.php";

		public static function enum() {
	        $reflect = new ReflectionClass(get_class());
	        return $reflect->getConstants();
    	}
	}
