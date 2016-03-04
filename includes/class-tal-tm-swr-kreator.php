<?php
	//DONE:110 test spl_autoload function

	class Tal_Tm_Swr_Kreator implements Tal_Tm_Swr_Interface_Kreator {

		public static function create($Item = "") {

			switch ($Item) {
				case Tal_Tm_Swr_Abstract_Factory_Items_Enum::Item:
					return new Tal_Tm_Swr_Item();
					break;
				case Tal_Tm_Swr_Abstract_Factory_Items_Enum::Collection:
					return new Tal_Tm_Swr_Collection();
					break;
				case Tal_Tm_Swr_Abstract_Factory_Items_Enum::Candidate:
					return new Tal_Tm_Swr_Candidate();
					break;
				case Tal_Tm_Swr_Abstract_Factory_Items_Enum::Candidates:
					return new Tal_Tm_Swr_Candidates();
					break;
				case Tal_Tm_Swr_Abstract_Factory_Items_Enum::Casting:
					return new Tal_Tm_Swr_Casting();
					break;
				case Tal_Tm_Swr_Abstract_Factory_Items_Enum::Form:
					return new Tal_Tm_Swr_Form();
					break;
				case Tal_Tm_Swr_Abstract_Factory_Items_Enum::Forms:
					return new Tal_Tm_Swr_Forms();
					break;
				case Tal_Tm_Swr_Abstract_Factory_Items_Enum::File_Upload:
					return new Tal_Tm_Swr_File_Upload();
					break;
				default:
					return null;
			}
		}
	}
