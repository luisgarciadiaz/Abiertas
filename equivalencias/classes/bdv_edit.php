<?php
namespace PHPMaker2020\project1;

/**
 * Page class
 */
class bdv_edit extends bdv
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{BCBBB89F-782F-4C8E-A4DB-F05CA52E74C8}";

	// Table name
	public $TableName = 'bdv';

	// Page object name
	public $PageObjName = "bdv_edit";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (bdv)
		if (!isset($GLOBALS["bdv"]) || get_class($GLOBALS["bdv"]) == PROJECT_NAMESPACE . "bdv") {
			$GLOBALS["bdv"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["bdv"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'bdv');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $bdv;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($bdv);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "bdvview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!$this->setupApiRequest())
			return FALSE;

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Get("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterValues[] = $keys; // Lookup values
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API request
	public function setupApiRequest()
	{
		global $Security;

		// Check security for API request
		If (ValidApiRequest()) {
			return TRUE;
		}
		return FALSE;
	}
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (!$this->setupApiRequest()) {
			$Security = new AdvancedSecurity();
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->setVisibility();
		$this->fecha->setVisibility();
		$this->hora->setVisibility();
		$this->audio->setVisibility();
		$this->st->setVisibility();
		$this->fechaHoraIni->setVisibility();
		$this->fechaHoraFin->setVisibility();
		$this->telefono->setVisibility();
		$this->agente->setVisibility();
		$this->fechabo->setVisibility();
		$this->agentebo->setVisibility();
		$this->comentariosbo->setVisibility();
		$this->IP->setVisibility();
		$this->actual->setVisibility();
		$this->completado->setVisibility();
		$this->_2_1_R->setVisibility();
		$this->_2_2_R->setVisibility();
		$this->_2_3_R->setVisibility();
		$this->_3_4_R->setVisibility();
		$this->_4_5_R->setVisibility();
		$this->_4_6_R->setVisibility();
		$this->_4_7_R->setVisibility();
		$this->_4_8_R->setVisibility();
		$this->_5_9_R->setVisibility();
		$this->_5_10_R->setVisibility();
		$this->_5_11_R->setVisibility();
		$this->_5_12_R->setVisibility();
		$this->_5_13_R->setVisibility();
		$this->_5_14_R->setVisibility();
		$this->_5_51_R->setVisibility();
		$this->_6_15_R->setVisibility();
		$this->_6_16_R->setVisibility();
		$this->_6_17_R->setVisibility();
		$this->_6_18_R->setVisibility();
		$this->_6_19_R->setVisibility();
		$this->_6_20_R->setVisibility();
		$this->_6_52_R->setVisibility();
		$this->_7_21_R->setVisibility();
		$this->_8_22_R->setVisibility();
		$this->_8_23_R->setVisibility();
		$this->_8_24_R->setVisibility();
		$this->_8_25_R->setVisibility();
		$this->_9_26_R->setVisibility();
		$this->_9_27_R->setVisibility();
		$this->_9_28_R->setVisibility();
		$this->_9_29_R->setVisibility();
		$this->_9_30_R->setVisibility();
		$this->_9_31_R->setVisibility();
		$this->_9_32_R->setVisibility();
		$this->_9_33_R->setVisibility();
		$this->_9_34_R->setVisibility();
		$this->_9_35_R->setVisibility();
		$this->_9_36_R->setVisibility();
		$this->_9_37_R->setVisibility();
		$this->_9_38_R->setVisibility();
		$this->_9_39_R->setVisibility();
		$this->_10_40_R->setVisibility();
		$this->_10_41_R->setVisibility();
		$this->_11_42_R->setVisibility();
		$this->_11_43_R->setVisibility();
		$this->_12_44_R->setVisibility();
		$this->_12_45_R->setVisibility();
		$this->_12_46_R->setVisibility();
		$this->_12_47_R->setVisibility();
		$this->_12_48_R->setVisibility();
		$this->_12_49_R->setVisibility();
		$this->_12_50_R->setVisibility();
		$this->_1__R->setVisibility();
		$this->_13_54_R->setVisibility();
		$this->_13_54_1_R->setVisibility();
		$this->_13_54_2_R->setVisibility();
		$this->_13_55_R->setVisibility();
		$this->_13_55_1_R->setVisibility();
		$this->_13_55_2_R->setVisibility();
		$this->_13_56_R->setVisibility();
		$this->_13_56_1_R->setVisibility();
		$this->_13_56_2_R->setVisibility();
		$this->_12_53_R->setVisibility();
		$this->_12_53_1_R->setVisibility();
		$this->_12_53_2_R->setVisibility();
		$this->_12_53_3_R->setVisibility();
		$this->_12_53_4_R->setVisibility();
		$this->_12_53_5_R->setVisibility();
		$this->_12_53_6_R->setVisibility();
		$this->_13_57_R->setVisibility();
		$this->_13_57_1_R->setVisibility();
		$this->_13_57_2_R->setVisibility();
		$this->_13_58_R->setVisibility();
		$this->_13_58_1_R->setVisibility();
		$this->_13_58_2_R->setVisibility();
		$this->_13_59_R->setVisibility();
		$this->_13_59_1_R->setVisibility();
		$this->_13_59_2_R->setVisibility();
		$this->_13_60_R->setVisibility();
		$this->_12_53_7_R->setVisibility();
		$this->_12_53_8_R->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_id")) {
				$this->id->setFormValue($CurrentForm->getValue("x_id"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$loadByQuery = TRUE;
			} else {
				$this->id->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->loadRow();

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("bdvlist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "bdvlist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);

		// Check field name 'fecha' first before field var 'x_fecha'
		$val = $CurrentForm->hasValue("fecha") ? $CurrentForm->getValue("fecha") : $CurrentForm->getValue("x_fecha");
		if (!$this->fecha->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fecha->Visible = FALSE; // Disable update for API request
			else
				$this->fecha->setFormValue($val);
			$this->fecha->CurrentValue = UnFormatDateTime($this->fecha->CurrentValue, 0);
		}

		// Check field name 'hora' first before field var 'x_hora'
		$val = $CurrentForm->hasValue("hora") ? $CurrentForm->getValue("hora") : $CurrentForm->getValue("x_hora");
		if (!$this->hora->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->hora->Visible = FALSE; // Disable update for API request
			else
				$this->hora->setFormValue($val);
			$this->hora->CurrentValue = UnFormatDateTime($this->hora->CurrentValue, 4);
		}

		// Check field name 'audio' first before field var 'x_audio'
		$val = $CurrentForm->hasValue("audio") ? $CurrentForm->getValue("audio") : $CurrentForm->getValue("x_audio");
		if (!$this->audio->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->audio->Visible = FALSE; // Disable update for API request
			else
				$this->audio->setFormValue($val);
		}

		// Check field name 'st' first before field var 'x_st'
		$val = $CurrentForm->hasValue("st") ? $CurrentForm->getValue("st") : $CurrentForm->getValue("x_st");
		if (!$this->st->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->st->Visible = FALSE; // Disable update for API request
			else
				$this->st->setFormValue($val);
		}

		// Check field name 'fechaHoraIni' first before field var 'x_fechaHoraIni'
		$val = $CurrentForm->hasValue("fechaHoraIni") ? $CurrentForm->getValue("fechaHoraIni") : $CurrentForm->getValue("x_fechaHoraIni");
		if (!$this->fechaHoraIni->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fechaHoraIni->Visible = FALSE; // Disable update for API request
			else
				$this->fechaHoraIni->setFormValue($val);
			$this->fechaHoraIni->CurrentValue = UnFormatDateTime($this->fechaHoraIni->CurrentValue, 0);
		}

		// Check field name 'fechaHoraFin' first before field var 'x_fechaHoraFin'
		$val = $CurrentForm->hasValue("fechaHoraFin") ? $CurrentForm->getValue("fechaHoraFin") : $CurrentForm->getValue("x_fechaHoraFin");
		if (!$this->fechaHoraFin->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fechaHoraFin->Visible = FALSE; // Disable update for API request
			else
				$this->fechaHoraFin->setFormValue($val);
			$this->fechaHoraFin->CurrentValue = UnFormatDateTime($this->fechaHoraFin->CurrentValue, 0);
		}

		// Check field name 'telefono' first before field var 'x_telefono'
		$val = $CurrentForm->hasValue("telefono") ? $CurrentForm->getValue("telefono") : $CurrentForm->getValue("x_telefono");
		if (!$this->telefono->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->telefono->Visible = FALSE; // Disable update for API request
			else
				$this->telefono->setFormValue($val);
		}

		// Check field name 'agente' first before field var 'x_agente'
		$val = $CurrentForm->hasValue("agente") ? $CurrentForm->getValue("agente") : $CurrentForm->getValue("x_agente");
		if (!$this->agente->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->agente->Visible = FALSE; // Disable update for API request
			else
				$this->agente->setFormValue($val);
		}

		// Check field name 'fechabo' first before field var 'x_fechabo'
		$val = $CurrentForm->hasValue("fechabo") ? $CurrentForm->getValue("fechabo") : $CurrentForm->getValue("x_fechabo");
		if (!$this->fechabo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fechabo->Visible = FALSE; // Disable update for API request
			else
				$this->fechabo->setFormValue($val);
			$this->fechabo->CurrentValue = UnFormatDateTime($this->fechabo->CurrentValue, 0);
		}

		// Check field name 'agentebo' first before field var 'x_agentebo'
		$val = $CurrentForm->hasValue("agentebo") ? $CurrentForm->getValue("agentebo") : $CurrentForm->getValue("x_agentebo");
		if (!$this->agentebo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->agentebo->Visible = FALSE; // Disable update for API request
			else
				$this->agentebo->setFormValue($val);
		}

		// Check field name 'comentariosbo' first before field var 'x_comentariosbo'
		$val = $CurrentForm->hasValue("comentariosbo") ? $CurrentForm->getValue("comentariosbo") : $CurrentForm->getValue("x_comentariosbo");
		if (!$this->comentariosbo->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->comentariosbo->Visible = FALSE; // Disable update for API request
			else
				$this->comentariosbo->setFormValue($val);
		}

		// Check field name 'IP' first before field var 'x_IP'
		$val = $CurrentForm->hasValue("IP") ? $CurrentForm->getValue("IP") : $CurrentForm->getValue("x_IP");
		if (!$this->IP->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->IP->Visible = FALSE; // Disable update for API request
			else
				$this->IP->setFormValue($val);
		}

		// Check field name 'actual' first before field var 'x_actual'
		$val = $CurrentForm->hasValue("actual") ? $CurrentForm->getValue("actual") : $CurrentForm->getValue("x_actual");
		if (!$this->actual->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->actual->Visible = FALSE; // Disable update for API request
			else
				$this->actual->setFormValue($val);
		}

		// Check field name 'completado' first before field var 'x_completado'
		$val = $CurrentForm->hasValue("completado") ? $CurrentForm->getValue("completado") : $CurrentForm->getValue("x_completado");
		if (!$this->completado->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->completado->Visible = FALSE; // Disable update for API request
			else
				$this->completado->setFormValue($val);
		}

		// Check field name '2_1_R' first before field var 'x__2_1_R'
		$val = $CurrentForm->hasValue("2_1_R") ? $CurrentForm->getValue("2_1_R") : $CurrentForm->getValue("x__2_1_R");
		if (!$this->_2_1_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_2_1_R->Visible = FALSE; // Disable update for API request
			else
				$this->_2_1_R->setFormValue($val);
		}

		// Check field name '2_2_R' first before field var 'x__2_2_R'
		$val = $CurrentForm->hasValue("2_2_R") ? $CurrentForm->getValue("2_2_R") : $CurrentForm->getValue("x__2_2_R");
		if (!$this->_2_2_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_2_2_R->Visible = FALSE; // Disable update for API request
			else
				$this->_2_2_R->setFormValue($val);
		}

		// Check field name '2_3_R' first before field var 'x__2_3_R'
		$val = $CurrentForm->hasValue("2_3_R") ? $CurrentForm->getValue("2_3_R") : $CurrentForm->getValue("x__2_3_R");
		if (!$this->_2_3_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_2_3_R->Visible = FALSE; // Disable update for API request
			else
				$this->_2_3_R->setFormValue($val);
		}

		// Check field name '3_4_R' first before field var 'x__3_4_R'
		$val = $CurrentForm->hasValue("3_4_R") ? $CurrentForm->getValue("3_4_R") : $CurrentForm->getValue("x__3_4_R");
		if (!$this->_3_4_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_3_4_R->Visible = FALSE; // Disable update for API request
			else
				$this->_3_4_R->setFormValue($val);
		}

		// Check field name '4_5_R' first before field var 'x__4_5_R'
		$val = $CurrentForm->hasValue("4_5_R") ? $CurrentForm->getValue("4_5_R") : $CurrentForm->getValue("x__4_5_R");
		if (!$this->_4_5_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_4_5_R->Visible = FALSE; // Disable update for API request
			else
				$this->_4_5_R->setFormValue($val);
		}

		// Check field name '4_6_R' first before field var 'x__4_6_R'
		$val = $CurrentForm->hasValue("4_6_R") ? $CurrentForm->getValue("4_6_R") : $CurrentForm->getValue("x__4_6_R");
		if (!$this->_4_6_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_4_6_R->Visible = FALSE; // Disable update for API request
			else
				$this->_4_6_R->setFormValue($val);
		}

		// Check field name '4_7_R' first before field var 'x__4_7_R'
		$val = $CurrentForm->hasValue("4_7_R") ? $CurrentForm->getValue("4_7_R") : $CurrentForm->getValue("x__4_7_R");
		if (!$this->_4_7_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_4_7_R->Visible = FALSE; // Disable update for API request
			else
				$this->_4_7_R->setFormValue($val);
		}

		// Check field name '4_8_R' first before field var 'x__4_8_R'
		$val = $CurrentForm->hasValue("4_8_R") ? $CurrentForm->getValue("4_8_R") : $CurrentForm->getValue("x__4_8_R");
		if (!$this->_4_8_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_4_8_R->Visible = FALSE; // Disable update for API request
			else
				$this->_4_8_R->setFormValue($val);
		}

		// Check field name '5_9_R' first before field var 'x__5_9_R'
		$val = $CurrentForm->hasValue("5_9_R") ? $CurrentForm->getValue("5_9_R") : $CurrentForm->getValue("x__5_9_R");
		if (!$this->_5_9_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_5_9_R->Visible = FALSE; // Disable update for API request
			else
				$this->_5_9_R->setFormValue($val);
		}

		// Check field name '5_10_R' first before field var 'x__5_10_R'
		$val = $CurrentForm->hasValue("5_10_R") ? $CurrentForm->getValue("5_10_R") : $CurrentForm->getValue("x__5_10_R");
		if (!$this->_5_10_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_5_10_R->Visible = FALSE; // Disable update for API request
			else
				$this->_5_10_R->setFormValue($val);
		}

		// Check field name '5_11_R' first before field var 'x__5_11_R'
		$val = $CurrentForm->hasValue("5_11_R") ? $CurrentForm->getValue("5_11_R") : $CurrentForm->getValue("x__5_11_R");
		if (!$this->_5_11_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_5_11_R->Visible = FALSE; // Disable update for API request
			else
				$this->_5_11_R->setFormValue($val);
		}

		// Check field name '5_12_R' first before field var 'x__5_12_R'
		$val = $CurrentForm->hasValue("5_12_R") ? $CurrentForm->getValue("5_12_R") : $CurrentForm->getValue("x__5_12_R");
		if (!$this->_5_12_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_5_12_R->Visible = FALSE; // Disable update for API request
			else
				$this->_5_12_R->setFormValue($val);
		}

		// Check field name '5_13_R' first before field var 'x__5_13_R'
		$val = $CurrentForm->hasValue("5_13_R") ? $CurrentForm->getValue("5_13_R") : $CurrentForm->getValue("x__5_13_R");
		if (!$this->_5_13_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_5_13_R->Visible = FALSE; // Disable update for API request
			else
				$this->_5_13_R->setFormValue($val);
		}

		// Check field name '5_14_R' first before field var 'x__5_14_R'
		$val = $CurrentForm->hasValue("5_14_R") ? $CurrentForm->getValue("5_14_R") : $CurrentForm->getValue("x__5_14_R");
		if (!$this->_5_14_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_5_14_R->Visible = FALSE; // Disable update for API request
			else
				$this->_5_14_R->setFormValue($val);
		}

		// Check field name '5_51_R' first before field var 'x__5_51_R'
		$val = $CurrentForm->hasValue("5_51_R") ? $CurrentForm->getValue("5_51_R") : $CurrentForm->getValue("x__5_51_R");
		if (!$this->_5_51_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_5_51_R->Visible = FALSE; // Disable update for API request
			else
				$this->_5_51_R->setFormValue($val);
		}

		// Check field name '6_15_R' first before field var 'x__6_15_R'
		$val = $CurrentForm->hasValue("6_15_R") ? $CurrentForm->getValue("6_15_R") : $CurrentForm->getValue("x__6_15_R");
		if (!$this->_6_15_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_6_15_R->Visible = FALSE; // Disable update for API request
			else
				$this->_6_15_R->setFormValue($val);
		}

		// Check field name '6_16_R' first before field var 'x__6_16_R'
		$val = $CurrentForm->hasValue("6_16_R") ? $CurrentForm->getValue("6_16_R") : $CurrentForm->getValue("x__6_16_R");
		if (!$this->_6_16_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_6_16_R->Visible = FALSE; // Disable update for API request
			else
				$this->_6_16_R->setFormValue($val);
		}

		// Check field name '6_17_R' first before field var 'x__6_17_R'
		$val = $CurrentForm->hasValue("6_17_R") ? $CurrentForm->getValue("6_17_R") : $CurrentForm->getValue("x__6_17_R");
		if (!$this->_6_17_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_6_17_R->Visible = FALSE; // Disable update for API request
			else
				$this->_6_17_R->setFormValue($val);
		}

		// Check field name '6_18_R' first before field var 'x__6_18_R'
		$val = $CurrentForm->hasValue("6_18_R") ? $CurrentForm->getValue("6_18_R") : $CurrentForm->getValue("x__6_18_R");
		if (!$this->_6_18_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_6_18_R->Visible = FALSE; // Disable update for API request
			else
				$this->_6_18_R->setFormValue($val);
		}

		// Check field name '6_19_R' first before field var 'x__6_19_R'
		$val = $CurrentForm->hasValue("6_19_R") ? $CurrentForm->getValue("6_19_R") : $CurrentForm->getValue("x__6_19_R");
		if (!$this->_6_19_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_6_19_R->Visible = FALSE; // Disable update for API request
			else
				$this->_6_19_R->setFormValue($val);
		}

		// Check field name '6_20_R' first before field var 'x__6_20_R'
		$val = $CurrentForm->hasValue("6_20_R") ? $CurrentForm->getValue("6_20_R") : $CurrentForm->getValue("x__6_20_R");
		if (!$this->_6_20_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_6_20_R->Visible = FALSE; // Disable update for API request
			else
				$this->_6_20_R->setFormValue($val);
		}

		// Check field name '6_52_R' first before field var 'x__6_52_R'
		$val = $CurrentForm->hasValue("6_52_R") ? $CurrentForm->getValue("6_52_R") : $CurrentForm->getValue("x__6_52_R");
		if (!$this->_6_52_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_6_52_R->Visible = FALSE; // Disable update for API request
			else
				$this->_6_52_R->setFormValue($val);
		}

		// Check field name '7_21_R' first before field var 'x__7_21_R'
		$val = $CurrentForm->hasValue("7_21_R") ? $CurrentForm->getValue("7_21_R") : $CurrentForm->getValue("x__7_21_R");
		if (!$this->_7_21_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_7_21_R->Visible = FALSE; // Disable update for API request
			else
				$this->_7_21_R->setFormValue($val);
		}

		// Check field name '8_22_R' first before field var 'x__8_22_R'
		$val = $CurrentForm->hasValue("8_22_R") ? $CurrentForm->getValue("8_22_R") : $CurrentForm->getValue("x__8_22_R");
		if (!$this->_8_22_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_8_22_R->Visible = FALSE; // Disable update for API request
			else
				$this->_8_22_R->setFormValue($val);
		}

		// Check field name '8_23_R' first before field var 'x__8_23_R'
		$val = $CurrentForm->hasValue("8_23_R") ? $CurrentForm->getValue("8_23_R") : $CurrentForm->getValue("x__8_23_R");
		if (!$this->_8_23_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_8_23_R->Visible = FALSE; // Disable update for API request
			else
				$this->_8_23_R->setFormValue($val);
		}

		// Check field name '8_24_R' first before field var 'x__8_24_R'
		$val = $CurrentForm->hasValue("8_24_R") ? $CurrentForm->getValue("8_24_R") : $CurrentForm->getValue("x__8_24_R");
		if (!$this->_8_24_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_8_24_R->Visible = FALSE; // Disable update for API request
			else
				$this->_8_24_R->setFormValue($val);
		}

		// Check field name '8_25_R' first before field var 'x__8_25_R'
		$val = $CurrentForm->hasValue("8_25_R") ? $CurrentForm->getValue("8_25_R") : $CurrentForm->getValue("x__8_25_R");
		if (!$this->_8_25_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_8_25_R->Visible = FALSE; // Disable update for API request
			else
				$this->_8_25_R->setFormValue($val);
		}

		// Check field name '9_26_R' first before field var 'x__9_26_R'
		$val = $CurrentForm->hasValue("9_26_R") ? $CurrentForm->getValue("9_26_R") : $CurrentForm->getValue("x__9_26_R");
		if (!$this->_9_26_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_9_26_R->Visible = FALSE; // Disable update for API request
			else
				$this->_9_26_R->setFormValue($val);
		}

		// Check field name '9_27_R' first before field var 'x__9_27_R'
		$val = $CurrentForm->hasValue("9_27_R") ? $CurrentForm->getValue("9_27_R") : $CurrentForm->getValue("x__9_27_R");
		if (!$this->_9_27_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_9_27_R->Visible = FALSE; // Disable update for API request
			else
				$this->_9_27_R->setFormValue($val);
		}

		// Check field name '9_28_R' first before field var 'x__9_28_R'
		$val = $CurrentForm->hasValue("9_28_R") ? $CurrentForm->getValue("9_28_R") : $CurrentForm->getValue("x__9_28_R");
		if (!$this->_9_28_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_9_28_R->Visible = FALSE; // Disable update for API request
			else
				$this->_9_28_R->setFormValue($val);
		}

		// Check field name '9_29_R' first before field var 'x__9_29_R'
		$val = $CurrentForm->hasValue("9_29_R") ? $CurrentForm->getValue("9_29_R") : $CurrentForm->getValue("x__9_29_R");
		if (!$this->_9_29_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_9_29_R->Visible = FALSE; // Disable update for API request
			else
				$this->_9_29_R->setFormValue($val);
		}

		// Check field name '9_30_R' first before field var 'x__9_30_R'
		$val = $CurrentForm->hasValue("9_30_R") ? $CurrentForm->getValue("9_30_R") : $CurrentForm->getValue("x__9_30_R");
		if (!$this->_9_30_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_9_30_R->Visible = FALSE; // Disable update for API request
			else
				$this->_9_30_R->setFormValue($val);
		}

		// Check field name '9_31_R' first before field var 'x__9_31_R'
		$val = $CurrentForm->hasValue("9_31_R") ? $CurrentForm->getValue("9_31_R") : $CurrentForm->getValue("x__9_31_R");
		if (!$this->_9_31_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_9_31_R->Visible = FALSE; // Disable update for API request
			else
				$this->_9_31_R->setFormValue($val);
		}

		// Check field name '9_32_R' first before field var 'x__9_32_R'
		$val = $CurrentForm->hasValue("9_32_R") ? $CurrentForm->getValue("9_32_R") : $CurrentForm->getValue("x__9_32_R");
		if (!$this->_9_32_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_9_32_R->Visible = FALSE; // Disable update for API request
			else
				$this->_9_32_R->setFormValue($val);
		}

		// Check field name '9_33_R' first before field var 'x__9_33_R'
		$val = $CurrentForm->hasValue("9_33_R") ? $CurrentForm->getValue("9_33_R") : $CurrentForm->getValue("x__9_33_R");
		if (!$this->_9_33_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_9_33_R->Visible = FALSE; // Disable update for API request
			else
				$this->_9_33_R->setFormValue($val);
		}

		// Check field name '9_34_R' first before field var 'x__9_34_R'
		$val = $CurrentForm->hasValue("9_34_R") ? $CurrentForm->getValue("9_34_R") : $CurrentForm->getValue("x__9_34_R");
		if (!$this->_9_34_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_9_34_R->Visible = FALSE; // Disable update for API request
			else
				$this->_9_34_R->setFormValue($val);
		}

		// Check field name '9_35_R' first before field var 'x__9_35_R'
		$val = $CurrentForm->hasValue("9_35_R") ? $CurrentForm->getValue("9_35_R") : $CurrentForm->getValue("x__9_35_R");
		if (!$this->_9_35_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_9_35_R->Visible = FALSE; // Disable update for API request
			else
				$this->_9_35_R->setFormValue($val);
		}

		// Check field name '9_36_R' first before field var 'x__9_36_R'
		$val = $CurrentForm->hasValue("9_36_R") ? $CurrentForm->getValue("9_36_R") : $CurrentForm->getValue("x__9_36_R");
		if (!$this->_9_36_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_9_36_R->Visible = FALSE; // Disable update for API request
			else
				$this->_9_36_R->setFormValue($val);
		}

		// Check field name '9_37_R' first before field var 'x__9_37_R'
		$val = $CurrentForm->hasValue("9_37_R") ? $CurrentForm->getValue("9_37_R") : $CurrentForm->getValue("x__9_37_R");
		if (!$this->_9_37_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_9_37_R->Visible = FALSE; // Disable update for API request
			else
				$this->_9_37_R->setFormValue($val);
		}

		// Check field name '9_38_R' first before field var 'x__9_38_R'
		$val = $CurrentForm->hasValue("9_38_R") ? $CurrentForm->getValue("9_38_R") : $CurrentForm->getValue("x__9_38_R");
		if (!$this->_9_38_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_9_38_R->Visible = FALSE; // Disable update for API request
			else
				$this->_9_38_R->setFormValue($val);
		}

		// Check field name '9_39_R' first before field var 'x__9_39_R'
		$val = $CurrentForm->hasValue("9_39_R") ? $CurrentForm->getValue("9_39_R") : $CurrentForm->getValue("x__9_39_R");
		if (!$this->_9_39_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_9_39_R->Visible = FALSE; // Disable update for API request
			else
				$this->_9_39_R->setFormValue($val);
		}

		// Check field name '10_40_R' first before field var 'x__10_40_R'
		$val = $CurrentForm->hasValue("10_40_R") ? $CurrentForm->getValue("10_40_R") : $CurrentForm->getValue("x__10_40_R");
		if (!$this->_10_40_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_10_40_R->Visible = FALSE; // Disable update for API request
			else
				$this->_10_40_R->setFormValue($val);
		}

		// Check field name '10_41_R' first before field var 'x__10_41_R'
		$val = $CurrentForm->hasValue("10_41_R") ? $CurrentForm->getValue("10_41_R") : $CurrentForm->getValue("x__10_41_R");
		if (!$this->_10_41_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_10_41_R->Visible = FALSE; // Disable update for API request
			else
				$this->_10_41_R->setFormValue($val);
		}

		// Check field name '11_42_R' first before field var 'x__11_42_R'
		$val = $CurrentForm->hasValue("11_42_R") ? $CurrentForm->getValue("11_42_R") : $CurrentForm->getValue("x__11_42_R");
		if (!$this->_11_42_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_11_42_R->Visible = FALSE; // Disable update for API request
			else
				$this->_11_42_R->setFormValue($val);
		}

		// Check field name '11_43_R' first before field var 'x__11_43_R'
		$val = $CurrentForm->hasValue("11_43_R") ? $CurrentForm->getValue("11_43_R") : $CurrentForm->getValue("x__11_43_R");
		if (!$this->_11_43_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_11_43_R->Visible = FALSE; // Disable update for API request
			else
				$this->_11_43_R->setFormValue($val);
		}

		// Check field name '12_44_R' first before field var 'x__12_44_R'
		$val = $CurrentForm->hasValue("12_44_R") ? $CurrentForm->getValue("12_44_R") : $CurrentForm->getValue("x__12_44_R");
		if (!$this->_12_44_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_44_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_44_R->setFormValue($val);
		}

		// Check field name '12_45_R' first before field var 'x__12_45_R'
		$val = $CurrentForm->hasValue("12_45_R") ? $CurrentForm->getValue("12_45_R") : $CurrentForm->getValue("x__12_45_R");
		if (!$this->_12_45_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_45_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_45_R->setFormValue($val);
		}

		// Check field name '12_46_R' first before field var 'x__12_46_R'
		$val = $CurrentForm->hasValue("12_46_R") ? $CurrentForm->getValue("12_46_R") : $CurrentForm->getValue("x__12_46_R");
		if (!$this->_12_46_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_46_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_46_R->setFormValue($val);
		}

		// Check field name '12_47_R' first before field var 'x__12_47_R'
		$val = $CurrentForm->hasValue("12_47_R") ? $CurrentForm->getValue("12_47_R") : $CurrentForm->getValue("x__12_47_R");
		if (!$this->_12_47_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_47_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_47_R->setFormValue($val);
		}

		// Check field name '12_48_R' first before field var 'x__12_48_R'
		$val = $CurrentForm->hasValue("12_48_R") ? $CurrentForm->getValue("12_48_R") : $CurrentForm->getValue("x__12_48_R");
		if (!$this->_12_48_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_48_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_48_R->setFormValue($val);
		}

		// Check field name '12_49_R' first before field var 'x__12_49_R'
		$val = $CurrentForm->hasValue("12_49_R") ? $CurrentForm->getValue("12_49_R") : $CurrentForm->getValue("x__12_49_R");
		if (!$this->_12_49_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_49_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_49_R->setFormValue($val);
		}

		// Check field name '12_50_R' first before field var 'x__12_50_R'
		$val = $CurrentForm->hasValue("12_50_R") ? $CurrentForm->getValue("12_50_R") : $CurrentForm->getValue("x__12_50_R");
		if (!$this->_12_50_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_50_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_50_R->setFormValue($val);
		}

		// Check field name '1__R' first before field var 'x__1__R'
		$val = $CurrentForm->hasValue("1__R") ? $CurrentForm->getValue("1__R") : $CurrentForm->getValue("x__1__R");
		if (!$this->_1__R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_1__R->Visible = FALSE; // Disable update for API request
			else
				$this->_1__R->setFormValue($val);
		}

		// Check field name '13_54_R' first before field var 'x__13_54_R'
		$val = $CurrentForm->hasValue("13_54_R") ? $CurrentForm->getValue("13_54_R") : $CurrentForm->getValue("x__13_54_R");
		if (!$this->_13_54_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_54_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_54_R->setFormValue($val);
		}

		// Check field name '13_54_1_R' first before field var 'x__13_54_1_R'
		$val = $CurrentForm->hasValue("13_54_1_R") ? $CurrentForm->getValue("13_54_1_R") : $CurrentForm->getValue("x__13_54_1_R");
		if (!$this->_13_54_1_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_54_1_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_54_1_R->setFormValue($val);
		}

		// Check field name '13_54_2_R' first before field var 'x__13_54_2_R'
		$val = $CurrentForm->hasValue("13_54_2_R") ? $CurrentForm->getValue("13_54_2_R") : $CurrentForm->getValue("x__13_54_2_R");
		if (!$this->_13_54_2_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_54_2_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_54_2_R->setFormValue($val);
		}

		// Check field name '13_55_R' first before field var 'x__13_55_R'
		$val = $CurrentForm->hasValue("13_55_R") ? $CurrentForm->getValue("13_55_R") : $CurrentForm->getValue("x__13_55_R");
		if (!$this->_13_55_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_55_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_55_R->setFormValue($val);
		}

		// Check field name '13_55_1_R' first before field var 'x__13_55_1_R'
		$val = $CurrentForm->hasValue("13_55_1_R") ? $CurrentForm->getValue("13_55_1_R") : $CurrentForm->getValue("x__13_55_1_R");
		if (!$this->_13_55_1_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_55_1_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_55_1_R->setFormValue($val);
		}

		// Check field name '13_55_2_R' first before field var 'x__13_55_2_R'
		$val = $CurrentForm->hasValue("13_55_2_R") ? $CurrentForm->getValue("13_55_2_R") : $CurrentForm->getValue("x__13_55_2_R");
		if (!$this->_13_55_2_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_55_2_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_55_2_R->setFormValue($val);
		}

		// Check field name '13_56_R' first before field var 'x__13_56_R'
		$val = $CurrentForm->hasValue("13_56_R") ? $CurrentForm->getValue("13_56_R") : $CurrentForm->getValue("x__13_56_R");
		if (!$this->_13_56_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_56_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_56_R->setFormValue($val);
		}

		// Check field name '13_56_1_R' first before field var 'x__13_56_1_R'
		$val = $CurrentForm->hasValue("13_56_1_R") ? $CurrentForm->getValue("13_56_1_R") : $CurrentForm->getValue("x__13_56_1_R");
		if (!$this->_13_56_1_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_56_1_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_56_1_R->setFormValue($val);
		}

		// Check field name '13_56_2_R' first before field var 'x__13_56_2_R'
		$val = $CurrentForm->hasValue("13_56_2_R") ? $CurrentForm->getValue("13_56_2_R") : $CurrentForm->getValue("x__13_56_2_R");
		if (!$this->_13_56_2_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_56_2_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_56_2_R->setFormValue($val);
		}

		// Check field name '12_53_R' first before field var 'x__12_53_R'
		$val = $CurrentForm->hasValue("12_53_R") ? $CurrentForm->getValue("12_53_R") : $CurrentForm->getValue("x__12_53_R");
		if (!$this->_12_53_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_53_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_53_R->setFormValue($val);
		}

		// Check field name '12_53_1_R' first before field var 'x__12_53_1_R'
		$val = $CurrentForm->hasValue("12_53_1_R") ? $CurrentForm->getValue("12_53_1_R") : $CurrentForm->getValue("x__12_53_1_R");
		if (!$this->_12_53_1_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_53_1_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_53_1_R->setFormValue($val);
		}

		// Check field name '12_53_2_R' first before field var 'x__12_53_2_R'
		$val = $CurrentForm->hasValue("12_53_2_R") ? $CurrentForm->getValue("12_53_2_R") : $CurrentForm->getValue("x__12_53_2_R");
		if (!$this->_12_53_2_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_53_2_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_53_2_R->setFormValue($val);
		}

		// Check field name '12_53_3_R' first before field var 'x__12_53_3_R'
		$val = $CurrentForm->hasValue("12_53_3_R") ? $CurrentForm->getValue("12_53_3_R") : $CurrentForm->getValue("x__12_53_3_R");
		if (!$this->_12_53_3_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_53_3_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_53_3_R->setFormValue($val);
		}

		// Check field name '12_53_4_R' first before field var 'x__12_53_4_R'
		$val = $CurrentForm->hasValue("12_53_4_R") ? $CurrentForm->getValue("12_53_4_R") : $CurrentForm->getValue("x__12_53_4_R");
		if (!$this->_12_53_4_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_53_4_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_53_4_R->setFormValue($val);
		}

		// Check field name '12_53_5_R' first before field var 'x__12_53_5_R'
		$val = $CurrentForm->hasValue("12_53_5_R") ? $CurrentForm->getValue("12_53_5_R") : $CurrentForm->getValue("x__12_53_5_R");
		if (!$this->_12_53_5_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_53_5_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_53_5_R->setFormValue($val);
		}

		// Check field name '12_53_6_R' first before field var 'x__12_53_6_R'
		$val = $CurrentForm->hasValue("12_53_6_R") ? $CurrentForm->getValue("12_53_6_R") : $CurrentForm->getValue("x__12_53_6_R");
		if (!$this->_12_53_6_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_53_6_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_53_6_R->setFormValue($val);
		}

		// Check field name '13_57_R' first before field var 'x__13_57_R'
		$val = $CurrentForm->hasValue("13_57_R") ? $CurrentForm->getValue("13_57_R") : $CurrentForm->getValue("x__13_57_R");
		if (!$this->_13_57_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_57_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_57_R->setFormValue($val);
		}

		// Check field name '13_57_1_R' first before field var 'x__13_57_1_R'
		$val = $CurrentForm->hasValue("13_57_1_R") ? $CurrentForm->getValue("13_57_1_R") : $CurrentForm->getValue("x__13_57_1_R");
		if (!$this->_13_57_1_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_57_1_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_57_1_R->setFormValue($val);
		}

		// Check field name '13_57_2_R' first before field var 'x__13_57_2_R'
		$val = $CurrentForm->hasValue("13_57_2_R") ? $CurrentForm->getValue("13_57_2_R") : $CurrentForm->getValue("x__13_57_2_R");
		if (!$this->_13_57_2_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_57_2_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_57_2_R->setFormValue($val);
		}

		// Check field name '13_58_R' first before field var 'x__13_58_R'
		$val = $CurrentForm->hasValue("13_58_R") ? $CurrentForm->getValue("13_58_R") : $CurrentForm->getValue("x__13_58_R");
		if (!$this->_13_58_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_58_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_58_R->setFormValue($val);
		}

		// Check field name '13_58_1_R' first before field var 'x__13_58_1_R'
		$val = $CurrentForm->hasValue("13_58_1_R") ? $CurrentForm->getValue("13_58_1_R") : $CurrentForm->getValue("x__13_58_1_R");
		if (!$this->_13_58_1_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_58_1_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_58_1_R->setFormValue($val);
		}

		// Check field name '13_58_2_R' first before field var 'x__13_58_2_R'
		$val = $CurrentForm->hasValue("13_58_2_R") ? $CurrentForm->getValue("13_58_2_R") : $CurrentForm->getValue("x__13_58_2_R");
		if (!$this->_13_58_2_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_58_2_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_58_2_R->setFormValue($val);
		}

		// Check field name '13_59_R' first before field var 'x__13_59_R'
		$val = $CurrentForm->hasValue("13_59_R") ? $CurrentForm->getValue("13_59_R") : $CurrentForm->getValue("x__13_59_R");
		if (!$this->_13_59_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_59_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_59_R->setFormValue($val);
		}

		// Check field name '13_59_1_R' first before field var 'x__13_59_1_R'
		$val = $CurrentForm->hasValue("13_59_1_R") ? $CurrentForm->getValue("13_59_1_R") : $CurrentForm->getValue("x__13_59_1_R");
		if (!$this->_13_59_1_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_59_1_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_59_1_R->setFormValue($val);
		}

		// Check field name '13_59_2_R' first before field var 'x__13_59_2_R'
		$val = $CurrentForm->hasValue("13_59_2_R") ? $CurrentForm->getValue("13_59_2_R") : $CurrentForm->getValue("x__13_59_2_R");
		if (!$this->_13_59_2_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_59_2_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_59_2_R->setFormValue($val);
		}

		// Check field name '13_60_R' first before field var 'x__13_60_R'
		$val = $CurrentForm->hasValue("13_60_R") ? $CurrentForm->getValue("13_60_R") : $CurrentForm->getValue("x__13_60_R");
		if (!$this->_13_60_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_13_60_R->Visible = FALSE; // Disable update for API request
			else
				$this->_13_60_R->setFormValue($val);
		}

		// Check field name '12_53_7_R' first before field var 'x__12_53_7_R'
		$val = $CurrentForm->hasValue("12_53_7_R") ? $CurrentForm->getValue("12_53_7_R") : $CurrentForm->getValue("x__12_53_7_R");
		if (!$this->_12_53_7_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_53_7_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_53_7_R->setFormValue($val);
		}

		// Check field name '12_53_8_R' first before field var 'x__12_53_8_R'
		$val = $CurrentForm->hasValue("12_53_8_R") ? $CurrentForm->getValue("12_53_8_R") : $CurrentForm->getValue("x__12_53_8_R");
		if (!$this->_12_53_8_R->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_12_53_8_R->Visible = FALSE; // Disable update for API request
			else
				$this->_12_53_8_R->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->fecha->CurrentValue = $this->fecha->FormValue;
		$this->fecha->CurrentValue = UnFormatDateTime($this->fecha->CurrentValue, 0);
		$this->hora->CurrentValue = $this->hora->FormValue;
		$this->hora->CurrentValue = UnFormatDateTime($this->hora->CurrentValue, 4);
		$this->audio->CurrentValue = $this->audio->FormValue;
		$this->st->CurrentValue = $this->st->FormValue;
		$this->fechaHoraIni->CurrentValue = $this->fechaHoraIni->FormValue;
		$this->fechaHoraIni->CurrentValue = UnFormatDateTime($this->fechaHoraIni->CurrentValue, 0);
		$this->fechaHoraFin->CurrentValue = $this->fechaHoraFin->FormValue;
		$this->fechaHoraFin->CurrentValue = UnFormatDateTime($this->fechaHoraFin->CurrentValue, 0);
		$this->telefono->CurrentValue = $this->telefono->FormValue;
		$this->agente->CurrentValue = $this->agente->FormValue;
		$this->fechabo->CurrentValue = $this->fechabo->FormValue;
		$this->fechabo->CurrentValue = UnFormatDateTime($this->fechabo->CurrentValue, 0);
		$this->agentebo->CurrentValue = $this->agentebo->FormValue;
		$this->comentariosbo->CurrentValue = $this->comentariosbo->FormValue;
		$this->IP->CurrentValue = $this->IP->FormValue;
		$this->actual->CurrentValue = $this->actual->FormValue;
		$this->completado->CurrentValue = $this->completado->FormValue;
		$this->_2_1_R->CurrentValue = $this->_2_1_R->FormValue;
		$this->_2_2_R->CurrentValue = $this->_2_2_R->FormValue;
		$this->_2_3_R->CurrentValue = $this->_2_3_R->FormValue;
		$this->_3_4_R->CurrentValue = $this->_3_4_R->FormValue;
		$this->_4_5_R->CurrentValue = $this->_4_5_R->FormValue;
		$this->_4_6_R->CurrentValue = $this->_4_6_R->FormValue;
		$this->_4_7_R->CurrentValue = $this->_4_7_R->FormValue;
		$this->_4_8_R->CurrentValue = $this->_4_8_R->FormValue;
		$this->_5_9_R->CurrentValue = $this->_5_9_R->FormValue;
		$this->_5_10_R->CurrentValue = $this->_5_10_R->FormValue;
		$this->_5_11_R->CurrentValue = $this->_5_11_R->FormValue;
		$this->_5_12_R->CurrentValue = $this->_5_12_R->FormValue;
		$this->_5_13_R->CurrentValue = $this->_5_13_R->FormValue;
		$this->_5_14_R->CurrentValue = $this->_5_14_R->FormValue;
		$this->_5_51_R->CurrentValue = $this->_5_51_R->FormValue;
		$this->_6_15_R->CurrentValue = $this->_6_15_R->FormValue;
		$this->_6_16_R->CurrentValue = $this->_6_16_R->FormValue;
		$this->_6_17_R->CurrentValue = $this->_6_17_R->FormValue;
		$this->_6_18_R->CurrentValue = $this->_6_18_R->FormValue;
		$this->_6_19_R->CurrentValue = $this->_6_19_R->FormValue;
		$this->_6_20_R->CurrentValue = $this->_6_20_R->FormValue;
		$this->_6_52_R->CurrentValue = $this->_6_52_R->FormValue;
		$this->_7_21_R->CurrentValue = $this->_7_21_R->FormValue;
		$this->_8_22_R->CurrentValue = $this->_8_22_R->FormValue;
		$this->_8_23_R->CurrentValue = $this->_8_23_R->FormValue;
		$this->_8_24_R->CurrentValue = $this->_8_24_R->FormValue;
		$this->_8_25_R->CurrentValue = $this->_8_25_R->FormValue;
		$this->_9_26_R->CurrentValue = $this->_9_26_R->FormValue;
		$this->_9_27_R->CurrentValue = $this->_9_27_R->FormValue;
		$this->_9_28_R->CurrentValue = $this->_9_28_R->FormValue;
		$this->_9_29_R->CurrentValue = $this->_9_29_R->FormValue;
		$this->_9_30_R->CurrentValue = $this->_9_30_R->FormValue;
		$this->_9_31_R->CurrentValue = $this->_9_31_R->FormValue;
		$this->_9_32_R->CurrentValue = $this->_9_32_R->FormValue;
		$this->_9_33_R->CurrentValue = $this->_9_33_R->FormValue;
		$this->_9_34_R->CurrentValue = $this->_9_34_R->FormValue;
		$this->_9_35_R->CurrentValue = $this->_9_35_R->FormValue;
		$this->_9_36_R->CurrentValue = $this->_9_36_R->FormValue;
		$this->_9_37_R->CurrentValue = $this->_9_37_R->FormValue;
		$this->_9_38_R->CurrentValue = $this->_9_38_R->FormValue;
		$this->_9_39_R->CurrentValue = $this->_9_39_R->FormValue;
		$this->_10_40_R->CurrentValue = $this->_10_40_R->FormValue;
		$this->_10_41_R->CurrentValue = $this->_10_41_R->FormValue;
		$this->_11_42_R->CurrentValue = $this->_11_42_R->FormValue;
		$this->_11_43_R->CurrentValue = $this->_11_43_R->FormValue;
		$this->_12_44_R->CurrentValue = $this->_12_44_R->FormValue;
		$this->_12_45_R->CurrentValue = $this->_12_45_R->FormValue;
		$this->_12_46_R->CurrentValue = $this->_12_46_R->FormValue;
		$this->_12_47_R->CurrentValue = $this->_12_47_R->FormValue;
		$this->_12_48_R->CurrentValue = $this->_12_48_R->FormValue;
		$this->_12_49_R->CurrentValue = $this->_12_49_R->FormValue;
		$this->_12_50_R->CurrentValue = $this->_12_50_R->FormValue;
		$this->_1__R->CurrentValue = $this->_1__R->FormValue;
		$this->_13_54_R->CurrentValue = $this->_13_54_R->FormValue;
		$this->_13_54_1_R->CurrentValue = $this->_13_54_1_R->FormValue;
		$this->_13_54_2_R->CurrentValue = $this->_13_54_2_R->FormValue;
		$this->_13_55_R->CurrentValue = $this->_13_55_R->FormValue;
		$this->_13_55_1_R->CurrentValue = $this->_13_55_1_R->FormValue;
		$this->_13_55_2_R->CurrentValue = $this->_13_55_2_R->FormValue;
		$this->_13_56_R->CurrentValue = $this->_13_56_R->FormValue;
		$this->_13_56_1_R->CurrentValue = $this->_13_56_1_R->FormValue;
		$this->_13_56_2_R->CurrentValue = $this->_13_56_2_R->FormValue;
		$this->_12_53_R->CurrentValue = $this->_12_53_R->FormValue;
		$this->_12_53_1_R->CurrentValue = $this->_12_53_1_R->FormValue;
		$this->_12_53_2_R->CurrentValue = $this->_12_53_2_R->FormValue;
		$this->_12_53_3_R->CurrentValue = $this->_12_53_3_R->FormValue;
		$this->_12_53_4_R->CurrentValue = $this->_12_53_4_R->FormValue;
		$this->_12_53_5_R->CurrentValue = $this->_12_53_5_R->FormValue;
		$this->_12_53_6_R->CurrentValue = $this->_12_53_6_R->FormValue;
		$this->_13_57_R->CurrentValue = $this->_13_57_R->FormValue;
		$this->_13_57_1_R->CurrentValue = $this->_13_57_1_R->FormValue;
		$this->_13_57_2_R->CurrentValue = $this->_13_57_2_R->FormValue;
		$this->_13_58_R->CurrentValue = $this->_13_58_R->FormValue;
		$this->_13_58_1_R->CurrentValue = $this->_13_58_1_R->FormValue;
		$this->_13_58_2_R->CurrentValue = $this->_13_58_2_R->FormValue;
		$this->_13_59_R->CurrentValue = $this->_13_59_R->FormValue;
		$this->_13_59_1_R->CurrentValue = $this->_13_59_1_R->FormValue;
		$this->_13_59_2_R->CurrentValue = $this->_13_59_2_R->FormValue;
		$this->_13_60_R->CurrentValue = $this->_13_60_R->FormValue;
		$this->_12_53_7_R->CurrentValue = $this->_12_53_7_R->FormValue;
		$this->_12_53_8_R->CurrentValue = $this->_12_53_8_R->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->fecha->setDbValue($row['fecha']);
		$this->hora->setDbValue($row['hora']);
		$this->audio->setDbValue($row['audio']);
		$this->st->setDbValue($row['st']);
		$this->fechaHoraIni->setDbValue($row['fechaHoraIni']);
		$this->fechaHoraFin->setDbValue($row['fechaHoraFin']);
		$this->telefono->setDbValue($row['telefono']);
		$this->agente->setDbValue($row['agente']);
		$this->fechabo->setDbValue($row['fechabo']);
		$this->agentebo->setDbValue($row['agentebo']);
		$this->comentariosbo->setDbValue($row['comentariosbo']);
		$this->IP->setDbValue($row['IP']);
		$this->actual->setDbValue($row['actual']);
		$this->completado->setDbValue($row['completado']);
		$this->_2_1_R->setDbValue($row['2_1_R']);
		$this->_2_2_R->setDbValue($row['2_2_R']);
		$this->_2_3_R->setDbValue($row['2_3_R']);
		$this->_3_4_R->setDbValue($row['3_4_R']);
		$this->_4_5_R->setDbValue($row['4_5_R']);
		$this->_4_6_R->setDbValue($row['4_6_R']);
		$this->_4_7_R->setDbValue($row['4_7_R']);
		$this->_4_8_R->setDbValue($row['4_8_R']);
		$this->_5_9_R->setDbValue($row['5_9_R']);
		$this->_5_10_R->setDbValue($row['5_10_R']);
		$this->_5_11_R->setDbValue($row['5_11_R']);
		$this->_5_12_R->setDbValue($row['5_12_R']);
		$this->_5_13_R->setDbValue($row['5_13_R']);
		$this->_5_14_R->setDbValue($row['5_14_R']);
		$this->_5_51_R->setDbValue($row['5_51_R']);
		$this->_6_15_R->setDbValue($row['6_15_R']);
		$this->_6_16_R->setDbValue($row['6_16_R']);
		$this->_6_17_R->setDbValue($row['6_17_R']);
		$this->_6_18_R->setDbValue($row['6_18_R']);
		$this->_6_19_R->setDbValue($row['6_19_R']);
		$this->_6_20_R->setDbValue($row['6_20_R']);
		$this->_6_52_R->setDbValue($row['6_52_R']);
		$this->_7_21_R->setDbValue($row['7_21_R']);
		$this->_8_22_R->setDbValue($row['8_22_R']);
		$this->_8_23_R->setDbValue($row['8_23_R']);
		$this->_8_24_R->setDbValue($row['8_24_R']);
		$this->_8_25_R->setDbValue($row['8_25_R']);
		$this->_9_26_R->setDbValue($row['9_26_R']);
		$this->_9_27_R->setDbValue($row['9_27_R']);
		$this->_9_28_R->setDbValue($row['9_28_R']);
		$this->_9_29_R->setDbValue($row['9_29_R']);
		$this->_9_30_R->setDbValue($row['9_30_R']);
		$this->_9_31_R->setDbValue($row['9_31_R']);
		$this->_9_32_R->setDbValue($row['9_32_R']);
		$this->_9_33_R->setDbValue($row['9_33_R']);
		$this->_9_34_R->setDbValue($row['9_34_R']);
		$this->_9_35_R->setDbValue($row['9_35_R']);
		$this->_9_36_R->setDbValue($row['9_36_R']);
		$this->_9_37_R->setDbValue($row['9_37_R']);
		$this->_9_38_R->setDbValue($row['9_38_R']);
		$this->_9_39_R->setDbValue($row['9_39_R']);
		$this->_10_40_R->setDbValue($row['10_40_R']);
		$this->_10_41_R->setDbValue($row['10_41_R']);
		$this->_11_42_R->setDbValue($row['11_42_R']);
		$this->_11_43_R->setDbValue($row['11_43_R']);
		$this->_12_44_R->setDbValue($row['12_44_R']);
		$this->_12_45_R->setDbValue($row['12_45_R']);
		$this->_12_46_R->setDbValue($row['12_46_R']);
		$this->_12_47_R->setDbValue($row['12_47_R']);
		$this->_12_48_R->setDbValue($row['12_48_R']);
		$this->_12_49_R->setDbValue($row['12_49_R']);
		$this->_12_50_R->setDbValue($row['12_50_R']);
		$this->_1__R->setDbValue($row['1__R']);
		$this->_13_54_R->setDbValue($row['13_54_R']);
		$this->_13_54_1_R->setDbValue($row['13_54_1_R']);
		$this->_13_54_2_R->setDbValue($row['13_54_2_R']);
		$this->_13_55_R->setDbValue($row['13_55_R']);
		$this->_13_55_1_R->setDbValue($row['13_55_1_R']);
		$this->_13_55_2_R->setDbValue($row['13_55_2_R']);
		$this->_13_56_R->setDbValue($row['13_56_R']);
		$this->_13_56_1_R->setDbValue($row['13_56_1_R']);
		$this->_13_56_2_R->setDbValue($row['13_56_2_R']);
		$this->_12_53_R->setDbValue($row['12_53_R']);
		$this->_12_53_1_R->setDbValue($row['12_53_1_R']);
		$this->_12_53_2_R->setDbValue($row['12_53_2_R']);
		$this->_12_53_3_R->setDbValue($row['12_53_3_R']);
		$this->_12_53_4_R->setDbValue($row['12_53_4_R']);
		$this->_12_53_5_R->setDbValue($row['12_53_5_R']);
		$this->_12_53_6_R->setDbValue($row['12_53_6_R']);
		$this->_13_57_R->setDbValue($row['13_57_R']);
		$this->_13_57_1_R->setDbValue($row['13_57_1_R']);
		$this->_13_57_2_R->setDbValue($row['13_57_2_R']);
		$this->_13_58_R->setDbValue($row['13_58_R']);
		$this->_13_58_1_R->setDbValue($row['13_58_1_R']);
		$this->_13_58_2_R->setDbValue($row['13_58_2_R']);
		$this->_13_59_R->setDbValue($row['13_59_R']);
		$this->_13_59_1_R->setDbValue($row['13_59_1_R']);
		$this->_13_59_2_R->setDbValue($row['13_59_2_R']);
		$this->_13_60_R->setDbValue($row['13_60_R']);
		$this->_12_53_7_R->setDbValue($row['12_53_7_R']);
		$this->_12_53_8_R->setDbValue($row['12_53_8_R']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['fecha'] = NULL;
		$row['hora'] = NULL;
		$row['audio'] = NULL;
		$row['st'] = NULL;
		$row['fechaHoraIni'] = NULL;
		$row['fechaHoraFin'] = NULL;
		$row['telefono'] = NULL;
		$row['agente'] = NULL;
		$row['fechabo'] = NULL;
		$row['agentebo'] = NULL;
		$row['comentariosbo'] = NULL;
		$row['IP'] = NULL;
		$row['actual'] = NULL;
		$row['completado'] = NULL;
		$row['2_1_R'] = NULL;
		$row['2_2_R'] = NULL;
		$row['2_3_R'] = NULL;
		$row['3_4_R'] = NULL;
		$row['4_5_R'] = NULL;
		$row['4_6_R'] = NULL;
		$row['4_7_R'] = NULL;
		$row['4_8_R'] = NULL;
		$row['5_9_R'] = NULL;
		$row['5_10_R'] = NULL;
		$row['5_11_R'] = NULL;
		$row['5_12_R'] = NULL;
		$row['5_13_R'] = NULL;
		$row['5_14_R'] = NULL;
		$row['5_51_R'] = NULL;
		$row['6_15_R'] = NULL;
		$row['6_16_R'] = NULL;
		$row['6_17_R'] = NULL;
		$row['6_18_R'] = NULL;
		$row['6_19_R'] = NULL;
		$row['6_20_R'] = NULL;
		$row['6_52_R'] = NULL;
		$row['7_21_R'] = NULL;
		$row['8_22_R'] = NULL;
		$row['8_23_R'] = NULL;
		$row['8_24_R'] = NULL;
		$row['8_25_R'] = NULL;
		$row['9_26_R'] = NULL;
		$row['9_27_R'] = NULL;
		$row['9_28_R'] = NULL;
		$row['9_29_R'] = NULL;
		$row['9_30_R'] = NULL;
		$row['9_31_R'] = NULL;
		$row['9_32_R'] = NULL;
		$row['9_33_R'] = NULL;
		$row['9_34_R'] = NULL;
		$row['9_35_R'] = NULL;
		$row['9_36_R'] = NULL;
		$row['9_37_R'] = NULL;
		$row['9_38_R'] = NULL;
		$row['9_39_R'] = NULL;
		$row['10_40_R'] = NULL;
		$row['10_41_R'] = NULL;
		$row['11_42_R'] = NULL;
		$row['11_43_R'] = NULL;
		$row['12_44_R'] = NULL;
		$row['12_45_R'] = NULL;
		$row['12_46_R'] = NULL;
		$row['12_47_R'] = NULL;
		$row['12_48_R'] = NULL;
		$row['12_49_R'] = NULL;
		$row['12_50_R'] = NULL;
		$row['1__R'] = NULL;
		$row['13_54_R'] = NULL;
		$row['13_54_1_R'] = NULL;
		$row['13_54_2_R'] = NULL;
		$row['13_55_R'] = NULL;
		$row['13_55_1_R'] = NULL;
		$row['13_55_2_R'] = NULL;
		$row['13_56_R'] = NULL;
		$row['13_56_1_R'] = NULL;
		$row['13_56_2_R'] = NULL;
		$row['12_53_R'] = NULL;
		$row['12_53_1_R'] = NULL;
		$row['12_53_2_R'] = NULL;
		$row['12_53_3_R'] = NULL;
		$row['12_53_4_R'] = NULL;
		$row['12_53_5_R'] = NULL;
		$row['12_53_6_R'] = NULL;
		$row['13_57_R'] = NULL;
		$row['13_57_1_R'] = NULL;
		$row['13_57_2_R'] = NULL;
		$row['13_58_R'] = NULL;
		$row['13_58_1_R'] = NULL;
		$row['13_58_2_R'] = NULL;
		$row['13_59_R'] = NULL;
		$row['13_59_1_R'] = NULL;
		$row['13_59_2_R'] = NULL;
		$row['13_60_R'] = NULL;
		$row['12_53_7_R'] = NULL;
		$row['12_53_8_R'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// fecha
		// hora
		// audio
		// st
		// fechaHoraIni
		// fechaHoraFin
		// telefono
		// agente
		// fechabo
		// agentebo
		// comentariosbo
		// IP
		// actual
		// completado
		// 2_1_R
		// 2_2_R
		// 2_3_R
		// 3_4_R
		// 4_5_R
		// 4_6_R
		// 4_7_R
		// 4_8_R
		// 5_9_R
		// 5_10_R
		// 5_11_R
		// 5_12_R
		// 5_13_R
		// 5_14_R
		// 5_51_R
		// 6_15_R
		// 6_16_R
		// 6_17_R
		// 6_18_R
		// 6_19_R
		// 6_20_R
		// 6_52_R
		// 7_21_R
		// 8_22_R
		// 8_23_R
		// 8_24_R
		// 8_25_R
		// 9_26_R
		// 9_27_R
		// 9_28_R
		// 9_29_R
		// 9_30_R
		// 9_31_R
		// 9_32_R
		// 9_33_R
		// 9_34_R
		// 9_35_R
		// 9_36_R
		// 9_37_R
		// 9_38_R
		// 9_39_R
		// 10_40_R
		// 10_41_R
		// 11_42_R
		// 11_43_R
		// 12_44_R
		// 12_45_R
		// 12_46_R
		// 12_47_R
		// 12_48_R
		// 12_49_R
		// 12_50_R
		// 1__R
		// 13_54_R
		// 13_54_1_R
		// 13_54_2_R
		// 13_55_R
		// 13_55_1_R
		// 13_55_2_R
		// 13_56_R
		// 13_56_1_R
		// 13_56_2_R
		// 12_53_R
		// 12_53_1_R
		// 12_53_2_R
		// 12_53_3_R
		// 12_53_4_R
		// 12_53_5_R
		// 12_53_6_R
		// 13_57_R
		// 13_57_1_R
		// 13_57_2_R
		// 13_58_R
		// 13_58_1_R
		// 13_58_2_R
		// 13_59_R
		// 13_59_1_R
		// 13_59_2_R
		// 13_60_R
		// 12_53_7_R
		// 12_53_8_R

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// fecha
			$this->fecha->ViewValue = $this->fecha->CurrentValue;
			$this->fecha->ViewValue = FormatDateTime($this->fecha->ViewValue, 0);
			$this->fecha->ViewCustomAttributes = "";

			// hora
			$this->hora->ViewValue = $this->hora->CurrentValue;
			$this->hora->ViewValue = FormatDateTime($this->hora->ViewValue, 4);
			$this->hora->ViewCustomAttributes = "";

			// audio
			$this->audio->ViewValue = $this->audio->CurrentValue;
			$this->audio->ViewCustomAttributes = "";

			// st
			$this->st->ViewValue = $this->st->CurrentValue;
			$this->st->ViewCustomAttributes = "";

			// fechaHoraIni
			$this->fechaHoraIni->ViewValue = $this->fechaHoraIni->CurrentValue;
			$this->fechaHoraIni->ViewValue = FormatDateTime($this->fechaHoraIni->ViewValue, 0);
			$this->fechaHoraIni->ViewCustomAttributes = "";

			// fechaHoraFin
			$this->fechaHoraFin->ViewValue = $this->fechaHoraFin->CurrentValue;
			$this->fechaHoraFin->ViewValue = FormatDateTime($this->fechaHoraFin->ViewValue, 0);
			$this->fechaHoraFin->ViewCustomAttributes = "";

			// telefono
			$this->telefono->ViewValue = $this->telefono->CurrentValue;
			$this->telefono->ViewCustomAttributes = "";

			// agente
			$this->agente->ViewValue = $this->agente->CurrentValue;
			$this->agente->ViewValue = FormatNumber($this->agente->ViewValue, 0, -2, -2, -2);
			$this->agente->ViewCustomAttributes = "";

			// fechabo
			$this->fechabo->ViewValue = $this->fechabo->CurrentValue;
			$this->fechabo->ViewValue = FormatDateTime($this->fechabo->ViewValue, 0);
			$this->fechabo->ViewCustomAttributes = "";

			// agentebo
			$this->agentebo->ViewValue = $this->agentebo->CurrentValue;
			$this->agentebo->ViewValue = FormatNumber($this->agentebo->ViewValue, 0, -2, -2, -2);
			$this->agentebo->ViewCustomAttributes = "";

			// comentariosbo
			$this->comentariosbo->ViewValue = $this->comentariosbo->CurrentValue;
			$this->comentariosbo->ViewCustomAttributes = "";

			// IP
			$this->IP->ViewValue = $this->IP->CurrentValue;
			$this->IP->ViewCustomAttributes = "";

			// actual
			$this->actual->ViewValue = $this->actual->CurrentValue;
			$this->actual->ViewCustomAttributes = "";

			// completado
			$this->completado->ViewValue = $this->completado->CurrentValue;
			$this->completado->ViewCustomAttributes = "";

			// 2_1_R
			$this->_2_1_R->ViewValue = $this->_2_1_R->CurrentValue;
			$this->_2_1_R->ViewCustomAttributes = "";

			// 2_2_R
			$this->_2_2_R->ViewValue = $this->_2_2_R->CurrentValue;
			$this->_2_2_R->ViewCustomAttributes = "";

			// 2_3_R
			$this->_2_3_R->ViewValue = $this->_2_3_R->CurrentValue;
			$this->_2_3_R->ViewCustomAttributes = "";

			// 3_4_R
			$this->_3_4_R->ViewValue = $this->_3_4_R->CurrentValue;
			$this->_3_4_R->ViewCustomAttributes = "";

			// 4_5_R
			$this->_4_5_R->ViewValue = $this->_4_5_R->CurrentValue;
			$this->_4_5_R->ViewCustomAttributes = "";

			// 4_6_R
			$this->_4_6_R->ViewValue = $this->_4_6_R->CurrentValue;
			$this->_4_6_R->ViewCustomAttributes = "";

			// 4_7_R
			$this->_4_7_R->ViewValue = $this->_4_7_R->CurrentValue;
			$this->_4_7_R->ViewCustomAttributes = "";

			// 4_8_R
			$this->_4_8_R->ViewValue = $this->_4_8_R->CurrentValue;
			$this->_4_8_R->ViewCustomAttributes = "";

			// 5_9_R
			$this->_5_9_R->ViewValue = $this->_5_9_R->CurrentValue;
			$this->_5_9_R->ViewCustomAttributes = "";

			// 5_10_R
			$this->_5_10_R->ViewValue = $this->_5_10_R->CurrentValue;
			$this->_5_10_R->ViewCustomAttributes = "";

			// 5_11_R
			$this->_5_11_R->ViewValue = $this->_5_11_R->CurrentValue;
			$this->_5_11_R->ViewCustomAttributes = "";

			// 5_12_R
			$this->_5_12_R->ViewValue = $this->_5_12_R->CurrentValue;
			$this->_5_12_R->ViewCustomAttributes = "";

			// 5_13_R
			$this->_5_13_R->ViewValue = $this->_5_13_R->CurrentValue;
			$this->_5_13_R->ViewCustomAttributes = "";

			// 5_14_R
			$this->_5_14_R->ViewValue = $this->_5_14_R->CurrentValue;
			$this->_5_14_R->ViewCustomAttributes = "";

			// 5_51_R
			$this->_5_51_R->ViewValue = $this->_5_51_R->CurrentValue;
			$this->_5_51_R->ViewCustomAttributes = "";

			// 6_15_R
			$this->_6_15_R->ViewValue = $this->_6_15_R->CurrentValue;
			$this->_6_15_R->ViewCustomAttributes = "";

			// 6_16_R
			$this->_6_16_R->ViewValue = $this->_6_16_R->CurrentValue;
			$this->_6_16_R->ViewCustomAttributes = "";

			// 6_17_R
			$this->_6_17_R->ViewValue = $this->_6_17_R->CurrentValue;
			$this->_6_17_R->ViewCustomAttributes = "";

			// 6_18_R
			$this->_6_18_R->ViewValue = $this->_6_18_R->CurrentValue;
			$this->_6_18_R->ViewCustomAttributes = "";

			// 6_19_R
			$this->_6_19_R->ViewValue = $this->_6_19_R->CurrentValue;
			$this->_6_19_R->ViewCustomAttributes = "";

			// 6_20_R
			$this->_6_20_R->ViewValue = $this->_6_20_R->CurrentValue;
			$this->_6_20_R->ViewCustomAttributes = "";

			// 6_52_R
			$this->_6_52_R->ViewValue = $this->_6_52_R->CurrentValue;
			$this->_6_52_R->ViewCustomAttributes = "";

			// 7_21_R
			$this->_7_21_R->ViewValue = $this->_7_21_R->CurrentValue;
			$this->_7_21_R->ViewCustomAttributes = "";

			// 8_22_R
			$this->_8_22_R->ViewValue = $this->_8_22_R->CurrentValue;
			$this->_8_22_R->ViewCustomAttributes = "";

			// 8_23_R
			$this->_8_23_R->ViewValue = $this->_8_23_R->CurrentValue;
			$this->_8_23_R->ViewCustomAttributes = "";

			// 8_24_R
			$this->_8_24_R->ViewValue = $this->_8_24_R->CurrentValue;
			$this->_8_24_R->ViewCustomAttributes = "";

			// 8_25_R
			$this->_8_25_R->ViewValue = $this->_8_25_R->CurrentValue;
			$this->_8_25_R->ViewCustomAttributes = "";

			// 9_26_R
			$this->_9_26_R->ViewValue = $this->_9_26_R->CurrentValue;
			$this->_9_26_R->ViewCustomAttributes = "";

			// 9_27_R
			$this->_9_27_R->ViewValue = $this->_9_27_R->CurrentValue;
			$this->_9_27_R->ViewCustomAttributes = "";

			// 9_28_R
			$this->_9_28_R->ViewValue = $this->_9_28_R->CurrentValue;
			$this->_9_28_R->ViewCustomAttributes = "";

			// 9_29_R
			$this->_9_29_R->ViewValue = $this->_9_29_R->CurrentValue;
			$this->_9_29_R->ViewCustomAttributes = "";

			// 9_30_R
			$this->_9_30_R->ViewValue = $this->_9_30_R->CurrentValue;
			$this->_9_30_R->ViewCustomAttributes = "";

			// 9_31_R
			$this->_9_31_R->ViewValue = $this->_9_31_R->CurrentValue;
			$this->_9_31_R->ViewCustomAttributes = "";

			// 9_32_R
			$this->_9_32_R->ViewValue = $this->_9_32_R->CurrentValue;
			$this->_9_32_R->ViewCustomAttributes = "";

			// 9_33_R
			$this->_9_33_R->ViewValue = $this->_9_33_R->CurrentValue;
			$this->_9_33_R->ViewCustomAttributes = "";

			// 9_34_R
			$this->_9_34_R->ViewValue = $this->_9_34_R->CurrentValue;
			$this->_9_34_R->ViewCustomAttributes = "";

			// 9_35_R
			$this->_9_35_R->ViewValue = $this->_9_35_R->CurrentValue;
			$this->_9_35_R->ViewCustomAttributes = "";

			// 9_36_R
			$this->_9_36_R->ViewValue = $this->_9_36_R->CurrentValue;
			$this->_9_36_R->ViewCustomAttributes = "";

			// 9_37_R
			$this->_9_37_R->ViewValue = $this->_9_37_R->CurrentValue;
			$this->_9_37_R->ViewCustomAttributes = "";

			// 9_38_R
			$this->_9_38_R->ViewValue = $this->_9_38_R->CurrentValue;
			$this->_9_38_R->ViewCustomAttributes = "";

			// 9_39_R
			$this->_9_39_R->ViewValue = $this->_9_39_R->CurrentValue;
			$this->_9_39_R->ViewCustomAttributes = "";

			// 10_40_R
			$this->_10_40_R->ViewValue = $this->_10_40_R->CurrentValue;
			$this->_10_40_R->ViewCustomAttributes = "";

			// 10_41_R
			$this->_10_41_R->ViewValue = $this->_10_41_R->CurrentValue;
			$this->_10_41_R->ViewCustomAttributes = "";

			// 11_42_R
			$this->_11_42_R->ViewValue = $this->_11_42_R->CurrentValue;
			$this->_11_42_R->ViewCustomAttributes = "";

			// 11_43_R
			$this->_11_43_R->ViewValue = $this->_11_43_R->CurrentValue;
			$this->_11_43_R->ViewCustomAttributes = "";

			// 12_44_R
			$this->_12_44_R->ViewValue = $this->_12_44_R->CurrentValue;
			$this->_12_44_R->ViewCustomAttributes = "";

			// 12_45_R
			$this->_12_45_R->ViewValue = $this->_12_45_R->CurrentValue;
			$this->_12_45_R->ViewCustomAttributes = "";

			// 12_46_R
			$this->_12_46_R->ViewValue = $this->_12_46_R->CurrentValue;
			$this->_12_46_R->ViewCustomAttributes = "";

			// 12_47_R
			$this->_12_47_R->ViewValue = $this->_12_47_R->CurrentValue;
			$this->_12_47_R->ViewCustomAttributes = "";

			// 12_48_R
			$this->_12_48_R->ViewValue = $this->_12_48_R->CurrentValue;
			$this->_12_48_R->ViewCustomAttributes = "";

			// 12_49_R
			$this->_12_49_R->ViewValue = $this->_12_49_R->CurrentValue;
			$this->_12_49_R->ViewCustomAttributes = "";

			// 12_50_R
			$this->_12_50_R->ViewValue = $this->_12_50_R->CurrentValue;
			$this->_12_50_R->ViewCustomAttributes = "";

			// 1__R
			$this->_1__R->ViewValue = $this->_1__R->CurrentValue;
			$this->_1__R->ViewCustomAttributes = "";

			// 13_54_R
			$this->_13_54_R->ViewValue = $this->_13_54_R->CurrentValue;
			$this->_13_54_R->ViewCustomAttributes = "";

			// 13_54_1_R
			$this->_13_54_1_R->ViewValue = $this->_13_54_1_R->CurrentValue;
			$this->_13_54_1_R->ViewCustomAttributes = "";

			// 13_54_2_R
			$this->_13_54_2_R->ViewValue = $this->_13_54_2_R->CurrentValue;
			$this->_13_54_2_R->ViewCustomAttributes = "";

			// 13_55_R
			$this->_13_55_R->ViewValue = $this->_13_55_R->CurrentValue;
			$this->_13_55_R->ViewCustomAttributes = "";

			// 13_55_1_R
			$this->_13_55_1_R->ViewValue = $this->_13_55_1_R->CurrentValue;
			$this->_13_55_1_R->ViewCustomAttributes = "";

			// 13_55_2_R
			$this->_13_55_2_R->ViewValue = $this->_13_55_2_R->CurrentValue;
			$this->_13_55_2_R->ViewCustomAttributes = "";

			// 13_56_R
			$this->_13_56_R->ViewValue = $this->_13_56_R->CurrentValue;
			$this->_13_56_R->ViewCustomAttributes = "";

			// 13_56_1_R
			$this->_13_56_1_R->ViewValue = $this->_13_56_1_R->CurrentValue;
			$this->_13_56_1_R->ViewCustomAttributes = "";

			// 13_56_2_R
			$this->_13_56_2_R->ViewValue = $this->_13_56_2_R->CurrentValue;
			$this->_13_56_2_R->ViewCustomAttributes = "";

			// 12_53_R
			$this->_12_53_R->ViewValue = $this->_12_53_R->CurrentValue;
			$this->_12_53_R->ViewCustomAttributes = "";

			// 12_53_1_R
			$this->_12_53_1_R->ViewValue = $this->_12_53_1_R->CurrentValue;
			$this->_12_53_1_R->ViewCustomAttributes = "";

			// 12_53_2_R
			$this->_12_53_2_R->ViewValue = $this->_12_53_2_R->CurrentValue;
			$this->_12_53_2_R->ViewCustomAttributes = "";

			// 12_53_3_R
			$this->_12_53_3_R->ViewValue = $this->_12_53_3_R->CurrentValue;
			$this->_12_53_3_R->ViewCustomAttributes = "";

			// 12_53_4_R
			$this->_12_53_4_R->ViewValue = $this->_12_53_4_R->CurrentValue;
			$this->_12_53_4_R->ViewCustomAttributes = "";

			// 12_53_5_R
			$this->_12_53_5_R->ViewValue = $this->_12_53_5_R->CurrentValue;
			$this->_12_53_5_R->ViewCustomAttributes = "";

			// 12_53_6_R
			$this->_12_53_6_R->ViewValue = $this->_12_53_6_R->CurrentValue;
			$this->_12_53_6_R->ViewCustomAttributes = "";

			// 13_57_R
			$this->_13_57_R->ViewValue = $this->_13_57_R->CurrentValue;
			$this->_13_57_R->ViewCustomAttributes = "";

			// 13_57_1_R
			$this->_13_57_1_R->ViewValue = $this->_13_57_1_R->CurrentValue;
			$this->_13_57_1_R->ViewCustomAttributes = "";

			// 13_57_2_R
			$this->_13_57_2_R->ViewValue = $this->_13_57_2_R->CurrentValue;
			$this->_13_57_2_R->ViewCustomAttributes = "";

			// 13_58_R
			$this->_13_58_R->ViewValue = $this->_13_58_R->CurrentValue;
			$this->_13_58_R->ViewCustomAttributes = "";

			// 13_58_1_R
			$this->_13_58_1_R->ViewValue = $this->_13_58_1_R->CurrentValue;
			$this->_13_58_1_R->ViewCustomAttributes = "";

			// 13_58_2_R
			$this->_13_58_2_R->ViewValue = $this->_13_58_2_R->CurrentValue;
			$this->_13_58_2_R->ViewCustomAttributes = "";

			// 13_59_R
			$this->_13_59_R->ViewValue = $this->_13_59_R->CurrentValue;
			$this->_13_59_R->ViewCustomAttributes = "";

			// 13_59_1_R
			$this->_13_59_1_R->ViewValue = $this->_13_59_1_R->CurrentValue;
			$this->_13_59_1_R->ViewCustomAttributes = "";

			// 13_59_2_R
			$this->_13_59_2_R->ViewValue = $this->_13_59_2_R->CurrentValue;
			$this->_13_59_2_R->ViewCustomAttributes = "";

			// 13_60_R
			$this->_13_60_R->ViewValue = $this->_13_60_R->CurrentValue;
			$this->_13_60_R->ViewCustomAttributes = "";

			// 12_53_7_R
			$this->_12_53_7_R->ViewValue = $this->_12_53_7_R->CurrentValue;
			$this->_12_53_7_R->ViewCustomAttributes = "";

			// 12_53_8_R
			$this->_12_53_8_R->ViewValue = $this->_12_53_8_R->CurrentValue;
			$this->_12_53_8_R->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// fecha
			$this->fecha->LinkCustomAttributes = "";
			$this->fecha->HrefValue = "";
			$this->fecha->TooltipValue = "";

			// hora
			$this->hora->LinkCustomAttributes = "";
			$this->hora->HrefValue = "";
			$this->hora->TooltipValue = "";

			// audio
			$this->audio->LinkCustomAttributes = "";
			$this->audio->HrefValue = "";
			$this->audio->TooltipValue = "";

			// st
			$this->st->LinkCustomAttributes = "";
			$this->st->HrefValue = "";
			$this->st->TooltipValue = "";

			// fechaHoraIni
			$this->fechaHoraIni->LinkCustomAttributes = "";
			$this->fechaHoraIni->HrefValue = "";
			$this->fechaHoraIni->TooltipValue = "";

			// fechaHoraFin
			$this->fechaHoraFin->LinkCustomAttributes = "";
			$this->fechaHoraFin->HrefValue = "";
			$this->fechaHoraFin->TooltipValue = "";

			// telefono
			$this->telefono->LinkCustomAttributes = "";
			$this->telefono->HrefValue = "";
			$this->telefono->TooltipValue = "";

			// agente
			$this->agente->LinkCustomAttributes = "";
			$this->agente->HrefValue = "";
			$this->agente->TooltipValue = "";

			// fechabo
			$this->fechabo->LinkCustomAttributes = "";
			$this->fechabo->HrefValue = "";
			$this->fechabo->TooltipValue = "";

			// agentebo
			$this->agentebo->LinkCustomAttributes = "";
			$this->agentebo->HrefValue = "";
			$this->agentebo->TooltipValue = "";

			// comentariosbo
			$this->comentariosbo->LinkCustomAttributes = "";
			$this->comentariosbo->HrefValue = "";
			$this->comentariosbo->TooltipValue = "";

			// IP
			$this->IP->LinkCustomAttributes = "";
			$this->IP->HrefValue = "";
			$this->IP->TooltipValue = "";

			// actual
			$this->actual->LinkCustomAttributes = "";
			$this->actual->HrefValue = "";
			$this->actual->TooltipValue = "";

			// completado
			$this->completado->LinkCustomAttributes = "";
			$this->completado->HrefValue = "";
			$this->completado->TooltipValue = "";

			// 2_1_R
			$this->_2_1_R->LinkCustomAttributes = "";
			$this->_2_1_R->HrefValue = "";
			$this->_2_1_R->TooltipValue = "";

			// 2_2_R
			$this->_2_2_R->LinkCustomAttributes = "";
			$this->_2_2_R->HrefValue = "";
			$this->_2_2_R->TooltipValue = "";

			// 2_3_R
			$this->_2_3_R->LinkCustomAttributes = "";
			$this->_2_3_R->HrefValue = "";
			$this->_2_3_R->TooltipValue = "";

			// 3_4_R
			$this->_3_4_R->LinkCustomAttributes = "";
			$this->_3_4_R->HrefValue = "";
			$this->_3_4_R->TooltipValue = "";

			// 4_5_R
			$this->_4_5_R->LinkCustomAttributes = "";
			$this->_4_5_R->HrefValue = "";
			$this->_4_5_R->TooltipValue = "";

			// 4_6_R
			$this->_4_6_R->LinkCustomAttributes = "";
			$this->_4_6_R->HrefValue = "";
			$this->_4_6_R->TooltipValue = "";

			// 4_7_R
			$this->_4_7_R->LinkCustomAttributes = "";
			$this->_4_7_R->HrefValue = "";
			$this->_4_7_R->TooltipValue = "";

			// 4_8_R
			$this->_4_8_R->LinkCustomAttributes = "";
			$this->_4_8_R->HrefValue = "";
			$this->_4_8_R->TooltipValue = "";

			// 5_9_R
			$this->_5_9_R->LinkCustomAttributes = "";
			$this->_5_9_R->HrefValue = "";
			$this->_5_9_R->TooltipValue = "";

			// 5_10_R
			$this->_5_10_R->LinkCustomAttributes = "";
			$this->_5_10_R->HrefValue = "";
			$this->_5_10_R->TooltipValue = "";

			// 5_11_R
			$this->_5_11_R->LinkCustomAttributes = "";
			$this->_5_11_R->HrefValue = "";
			$this->_5_11_R->TooltipValue = "";

			// 5_12_R
			$this->_5_12_R->LinkCustomAttributes = "";
			$this->_5_12_R->HrefValue = "";
			$this->_5_12_R->TooltipValue = "";

			// 5_13_R
			$this->_5_13_R->LinkCustomAttributes = "";
			$this->_5_13_R->HrefValue = "";
			$this->_5_13_R->TooltipValue = "";

			// 5_14_R
			$this->_5_14_R->LinkCustomAttributes = "";
			$this->_5_14_R->HrefValue = "";
			$this->_5_14_R->TooltipValue = "";

			// 5_51_R
			$this->_5_51_R->LinkCustomAttributes = "";
			$this->_5_51_R->HrefValue = "";
			$this->_5_51_R->TooltipValue = "";

			// 6_15_R
			$this->_6_15_R->LinkCustomAttributes = "";
			$this->_6_15_R->HrefValue = "";
			$this->_6_15_R->TooltipValue = "";

			// 6_16_R
			$this->_6_16_R->LinkCustomAttributes = "";
			$this->_6_16_R->HrefValue = "";
			$this->_6_16_R->TooltipValue = "";

			// 6_17_R
			$this->_6_17_R->LinkCustomAttributes = "";
			$this->_6_17_R->HrefValue = "";
			$this->_6_17_R->TooltipValue = "";

			// 6_18_R
			$this->_6_18_R->LinkCustomAttributes = "";
			$this->_6_18_R->HrefValue = "";
			$this->_6_18_R->TooltipValue = "";

			// 6_19_R
			$this->_6_19_R->LinkCustomAttributes = "";
			$this->_6_19_R->HrefValue = "";
			$this->_6_19_R->TooltipValue = "";

			// 6_20_R
			$this->_6_20_R->LinkCustomAttributes = "";
			$this->_6_20_R->HrefValue = "";
			$this->_6_20_R->TooltipValue = "";

			// 6_52_R
			$this->_6_52_R->LinkCustomAttributes = "";
			$this->_6_52_R->HrefValue = "";
			$this->_6_52_R->TooltipValue = "";

			// 7_21_R
			$this->_7_21_R->LinkCustomAttributes = "";
			$this->_7_21_R->HrefValue = "";
			$this->_7_21_R->TooltipValue = "";

			// 8_22_R
			$this->_8_22_R->LinkCustomAttributes = "";
			$this->_8_22_R->HrefValue = "";
			$this->_8_22_R->TooltipValue = "";

			// 8_23_R
			$this->_8_23_R->LinkCustomAttributes = "";
			$this->_8_23_R->HrefValue = "";
			$this->_8_23_R->TooltipValue = "";

			// 8_24_R
			$this->_8_24_R->LinkCustomAttributes = "";
			$this->_8_24_R->HrefValue = "";
			$this->_8_24_R->TooltipValue = "";

			// 8_25_R
			$this->_8_25_R->LinkCustomAttributes = "";
			$this->_8_25_R->HrefValue = "";
			$this->_8_25_R->TooltipValue = "";

			// 9_26_R
			$this->_9_26_R->LinkCustomAttributes = "";
			$this->_9_26_R->HrefValue = "";
			$this->_9_26_R->TooltipValue = "";

			// 9_27_R
			$this->_9_27_R->LinkCustomAttributes = "";
			$this->_9_27_R->HrefValue = "";
			$this->_9_27_R->TooltipValue = "";

			// 9_28_R
			$this->_9_28_R->LinkCustomAttributes = "";
			$this->_9_28_R->HrefValue = "";
			$this->_9_28_R->TooltipValue = "";

			// 9_29_R
			$this->_9_29_R->LinkCustomAttributes = "";
			$this->_9_29_R->HrefValue = "";
			$this->_9_29_R->TooltipValue = "";

			// 9_30_R
			$this->_9_30_R->LinkCustomAttributes = "";
			$this->_9_30_R->HrefValue = "";
			$this->_9_30_R->TooltipValue = "";

			// 9_31_R
			$this->_9_31_R->LinkCustomAttributes = "";
			$this->_9_31_R->HrefValue = "";
			$this->_9_31_R->TooltipValue = "";

			// 9_32_R
			$this->_9_32_R->LinkCustomAttributes = "";
			$this->_9_32_R->HrefValue = "";
			$this->_9_32_R->TooltipValue = "";

			// 9_33_R
			$this->_9_33_R->LinkCustomAttributes = "";
			$this->_9_33_R->HrefValue = "";
			$this->_9_33_R->TooltipValue = "";

			// 9_34_R
			$this->_9_34_R->LinkCustomAttributes = "";
			$this->_9_34_R->HrefValue = "";
			$this->_9_34_R->TooltipValue = "";

			// 9_35_R
			$this->_9_35_R->LinkCustomAttributes = "";
			$this->_9_35_R->HrefValue = "";
			$this->_9_35_R->TooltipValue = "";

			// 9_36_R
			$this->_9_36_R->LinkCustomAttributes = "";
			$this->_9_36_R->HrefValue = "";
			$this->_9_36_R->TooltipValue = "";

			// 9_37_R
			$this->_9_37_R->LinkCustomAttributes = "";
			$this->_9_37_R->HrefValue = "";
			$this->_9_37_R->TooltipValue = "";

			// 9_38_R
			$this->_9_38_R->LinkCustomAttributes = "";
			$this->_9_38_R->HrefValue = "";
			$this->_9_38_R->TooltipValue = "";

			// 9_39_R
			$this->_9_39_R->LinkCustomAttributes = "";
			$this->_9_39_R->HrefValue = "";
			$this->_9_39_R->TooltipValue = "";

			// 10_40_R
			$this->_10_40_R->LinkCustomAttributes = "";
			$this->_10_40_R->HrefValue = "";
			$this->_10_40_R->TooltipValue = "";

			// 10_41_R
			$this->_10_41_R->LinkCustomAttributes = "";
			$this->_10_41_R->HrefValue = "";
			$this->_10_41_R->TooltipValue = "";

			// 11_42_R
			$this->_11_42_R->LinkCustomAttributes = "";
			$this->_11_42_R->HrefValue = "";
			$this->_11_42_R->TooltipValue = "";

			// 11_43_R
			$this->_11_43_R->LinkCustomAttributes = "";
			$this->_11_43_R->HrefValue = "";
			$this->_11_43_R->TooltipValue = "";

			// 12_44_R
			$this->_12_44_R->LinkCustomAttributes = "";
			$this->_12_44_R->HrefValue = "";
			$this->_12_44_R->TooltipValue = "";

			// 12_45_R
			$this->_12_45_R->LinkCustomAttributes = "";
			$this->_12_45_R->HrefValue = "";
			$this->_12_45_R->TooltipValue = "";

			// 12_46_R
			$this->_12_46_R->LinkCustomAttributes = "";
			$this->_12_46_R->HrefValue = "";
			$this->_12_46_R->TooltipValue = "";

			// 12_47_R
			$this->_12_47_R->LinkCustomAttributes = "";
			$this->_12_47_R->HrefValue = "";
			$this->_12_47_R->TooltipValue = "";

			// 12_48_R
			$this->_12_48_R->LinkCustomAttributes = "";
			$this->_12_48_R->HrefValue = "";
			$this->_12_48_R->TooltipValue = "";

			// 12_49_R
			$this->_12_49_R->LinkCustomAttributes = "";
			$this->_12_49_R->HrefValue = "";
			$this->_12_49_R->TooltipValue = "";

			// 12_50_R
			$this->_12_50_R->LinkCustomAttributes = "";
			$this->_12_50_R->HrefValue = "";
			$this->_12_50_R->TooltipValue = "";

			// 1__R
			$this->_1__R->LinkCustomAttributes = "";
			$this->_1__R->HrefValue = "";
			$this->_1__R->TooltipValue = "";

			// 13_54_R
			$this->_13_54_R->LinkCustomAttributes = "";
			$this->_13_54_R->HrefValue = "";
			$this->_13_54_R->TooltipValue = "";

			// 13_54_1_R
			$this->_13_54_1_R->LinkCustomAttributes = "";
			$this->_13_54_1_R->HrefValue = "";
			$this->_13_54_1_R->TooltipValue = "";

			// 13_54_2_R
			$this->_13_54_2_R->LinkCustomAttributes = "";
			$this->_13_54_2_R->HrefValue = "";
			$this->_13_54_2_R->TooltipValue = "";

			// 13_55_R
			$this->_13_55_R->LinkCustomAttributes = "";
			$this->_13_55_R->HrefValue = "";
			$this->_13_55_R->TooltipValue = "";

			// 13_55_1_R
			$this->_13_55_1_R->LinkCustomAttributes = "";
			$this->_13_55_1_R->HrefValue = "";
			$this->_13_55_1_R->TooltipValue = "";

			// 13_55_2_R
			$this->_13_55_2_R->LinkCustomAttributes = "";
			$this->_13_55_2_R->HrefValue = "";
			$this->_13_55_2_R->TooltipValue = "";

			// 13_56_R
			$this->_13_56_R->LinkCustomAttributes = "";
			$this->_13_56_R->HrefValue = "";
			$this->_13_56_R->TooltipValue = "";

			// 13_56_1_R
			$this->_13_56_1_R->LinkCustomAttributes = "";
			$this->_13_56_1_R->HrefValue = "";
			$this->_13_56_1_R->TooltipValue = "";

			// 13_56_2_R
			$this->_13_56_2_R->LinkCustomAttributes = "";
			$this->_13_56_2_R->HrefValue = "";
			$this->_13_56_2_R->TooltipValue = "";

			// 12_53_R
			$this->_12_53_R->LinkCustomAttributes = "";
			$this->_12_53_R->HrefValue = "";
			$this->_12_53_R->TooltipValue = "";

			// 12_53_1_R
			$this->_12_53_1_R->LinkCustomAttributes = "";
			$this->_12_53_1_R->HrefValue = "";
			$this->_12_53_1_R->TooltipValue = "";

			// 12_53_2_R
			$this->_12_53_2_R->LinkCustomAttributes = "";
			$this->_12_53_2_R->HrefValue = "";
			$this->_12_53_2_R->TooltipValue = "";

			// 12_53_3_R
			$this->_12_53_3_R->LinkCustomAttributes = "";
			$this->_12_53_3_R->HrefValue = "";
			$this->_12_53_3_R->TooltipValue = "";

			// 12_53_4_R
			$this->_12_53_4_R->LinkCustomAttributes = "";
			$this->_12_53_4_R->HrefValue = "";
			$this->_12_53_4_R->TooltipValue = "";

			// 12_53_5_R
			$this->_12_53_5_R->LinkCustomAttributes = "";
			$this->_12_53_5_R->HrefValue = "";
			$this->_12_53_5_R->TooltipValue = "";

			// 12_53_6_R
			$this->_12_53_6_R->LinkCustomAttributes = "";
			$this->_12_53_6_R->HrefValue = "";
			$this->_12_53_6_R->TooltipValue = "";

			// 13_57_R
			$this->_13_57_R->LinkCustomAttributes = "";
			$this->_13_57_R->HrefValue = "";
			$this->_13_57_R->TooltipValue = "";

			// 13_57_1_R
			$this->_13_57_1_R->LinkCustomAttributes = "";
			$this->_13_57_1_R->HrefValue = "";
			$this->_13_57_1_R->TooltipValue = "";

			// 13_57_2_R
			$this->_13_57_2_R->LinkCustomAttributes = "";
			$this->_13_57_2_R->HrefValue = "";
			$this->_13_57_2_R->TooltipValue = "";

			// 13_58_R
			$this->_13_58_R->LinkCustomAttributes = "";
			$this->_13_58_R->HrefValue = "";
			$this->_13_58_R->TooltipValue = "";

			// 13_58_1_R
			$this->_13_58_1_R->LinkCustomAttributes = "";
			$this->_13_58_1_R->HrefValue = "";
			$this->_13_58_1_R->TooltipValue = "";

			// 13_58_2_R
			$this->_13_58_2_R->LinkCustomAttributes = "";
			$this->_13_58_2_R->HrefValue = "";
			$this->_13_58_2_R->TooltipValue = "";

			// 13_59_R
			$this->_13_59_R->LinkCustomAttributes = "";
			$this->_13_59_R->HrefValue = "";
			$this->_13_59_R->TooltipValue = "";

			// 13_59_1_R
			$this->_13_59_1_R->LinkCustomAttributes = "";
			$this->_13_59_1_R->HrefValue = "";
			$this->_13_59_1_R->TooltipValue = "";

			// 13_59_2_R
			$this->_13_59_2_R->LinkCustomAttributes = "";
			$this->_13_59_2_R->HrefValue = "";
			$this->_13_59_2_R->TooltipValue = "";

			// 13_60_R
			$this->_13_60_R->LinkCustomAttributes = "";
			$this->_13_60_R->HrefValue = "";
			$this->_13_60_R->TooltipValue = "";

			// 12_53_7_R
			$this->_12_53_7_R->LinkCustomAttributes = "";
			$this->_12_53_7_R->HrefValue = "";
			$this->_12_53_7_R->TooltipValue = "";

			// 12_53_8_R
			$this->_12_53_8_R->LinkCustomAttributes = "";
			$this->_12_53_8_R->HrefValue = "";
			$this->_12_53_8_R->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// fecha
			$this->fecha->EditAttrs["class"] = "form-control";
			$this->fecha->EditCustomAttributes = "";
			$this->fecha->EditValue = HtmlEncode(FormatDateTime($this->fecha->CurrentValue, 8));
			$this->fecha->PlaceHolder = RemoveHtml($this->fecha->caption());

			// hora
			$this->hora->EditAttrs["class"] = "form-control";
			$this->hora->EditCustomAttributes = "";
			$this->hora->EditValue = HtmlEncode($this->hora->CurrentValue);
			$this->hora->PlaceHolder = RemoveHtml($this->hora->caption());

			// audio
			$this->audio->EditAttrs["class"] = "form-control";
			$this->audio->EditCustomAttributes = "";
			if (!$this->audio->Raw)
				$this->audio->CurrentValue = HtmlDecode($this->audio->CurrentValue);
			$this->audio->EditValue = HtmlEncode($this->audio->CurrentValue);
			$this->audio->PlaceHolder = RemoveHtml($this->audio->caption());

			// st
			$this->st->EditAttrs["class"] = "form-control";
			$this->st->EditCustomAttributes = "";
			if (!$this->st->Raw)
				$this->st->CurrentValue = HtmlDecode($this->st->CurrentValue);
			$this->st->EditValue = HtmlEncode($this->st->CurrentValue);
			$this->st->PlaceHolder = RemoveHtml($this->st->caption());

			// fechaHoraIni
			$this->fechaHoraIni->EditAttrs["class"] = "form-control";
			$this->fechaHoraIni->EditCustomAttributes = "";
			$this->fechaHoraIni->EditValue = HtmlEncode(FormatDateTime($this->fechaHoraIni->CurrentValue, 8));
			$this->fechaHoraIni->PlaceHolder = RemoveHtml($this->fechaHoraIni->caption());

			// fechaHoraFin
			$this->fechaHoraFin->EditAttrs["class"] = "form-control";
			$this->fechaHoraFin->EditCustomAttributes = "";
			$this->fechaHoraFin->EditValue = HtmlEncode(FormatDateTime($this->fechaHoraFin->CurrentValue, 8));
			$this->fechaHoraFin->PlaceHolder = RemoveHtml($this->fechaHoraFin->caption());

			// telefono
			$this->telefono->EditAttrs["class"] = "form-control";
			$this->telefono->EditCustomAttributes = "";
			if (!$this->telefono->Raw)
				$this->telefono->CurrentValue = HtmlDecode($this->telefono->CurrentValue);
			$this->telefono->EditValue = HtmlEncode($this->telefono->CurrentValue);
			$this->telefono->PlaceHolder = RemoveHtml($this->telefono->caption());

			// agente
			$this->agente->EditAttrs["class"] = "form-control";
			$this->agente->EditCustomAttributes = "";
			$this->agente->EditValue = HtmlEncode($this->agente->CurrentValue);
			$this->agente->PlaceHolder = RemoveHtml($this->agente->caption());

			// fechabo
			$this->fechabo->EditAttrs["class"] = "form-control";
			$this->fechabo->EditCustomAttributes = "";
			$this->fechabo->EditValue = HtmlEncode(FormatDateTime($this->fechabo->CurrentValue, 8));
			$this->fechabo->PlaceHolder = RemoveHtml($this->fechabo->caption());

			// agentebo
			$this->agentebo->EditAttrs["class"] = "form-control";
			$this->agentebo->EditCustomAttributes = "";
			$this->agentebo->EditValue = HtmlEncode($this->agentebo->CurrentValue);
			$this->agentebo->PlaceHolder = RemoveHtml($this->agentebo->caption());

			// comentariosbo
			$this->comentariosbo->EditAttrs["class"] = "form-control";
			$this->comentariosbo->EditCustomAttributes = "";
			$this->comentariosbo->EditValue = HtmlEncode($this->comentariosbo->CurrentValue);
			$this->comentariosbo->PlaceHolder = RemoveHtml($this->comentariosbo->caption());

			// IP
			$this->IP->EditAttrs["class"] = "form-control";
			$this->IP->EditCustomAttributes = "";
			if (!$this->IP->Raw)
				$this->IP->CurrentValue = HtmlDecode($this->IP->CurrentValue);
			$this->IP->EditValue = HtmlEncode($this->IP->CurrentValue);
			$this->IP->PlaceHolder = RemoveHtml($this->IP->caption());

			// actual
			$this->actual->EditAttrs["class"] = "form-control";
			$this->actual->EditCustomAttributes = "";
			if (!$this->actual->Raw)
				$this->actual->CurrentValue = HtmlDecode($this->actual->CurrentValue);
			$this->actual->EditValue = HtmlEncode($this->actual->CurrentValue);
			$this->actual->PlaceHolder = RemoveHtml($this->actual->caption());

			// completado
			$this->completado->EditAttrs["class"] = "form-control";
			$this->completado->EditCustomAttributes = "";
			if (!$this->completado->Raw)
				$this->completado->CurrentValue = HtmlDecode($this->completado->CurrentValue);
			$this->completado->EditValue = HtmlEncode($this->completado->CurrentValue);
			$this->completado->PlaceHolder = RemoveHtml($this->completado->caption());

			// 2_1_R
			$this->_2_1_R->EditAttrs["class"] = "form-control";
			$this->_2_1_R->EditCustomAttributes = "";
			$this->_2_1_R->EditValue = HtmlEncode($this->_2_1_R->CurrentValue);
			$this->_2_1_R->PlaceHolder = RemoveHtml($this->_2_1_R->caption());

			// 2_2_R
			$this->_2_2_R->EditAttrs["class"] = "form-control";
			$this->_2_2_R->EditCustomAttributes = "";
			$this->_2_2_R->EditValue = HtmlEncode($this->_2_2_R->CurrentValue);
			$this->_2_2_R->PlaceHolder = RemoveHtml($this->_2_2_R->caption());

			// 2_3_R
			$this->_2_3_R->EditAttrs["class"] = "form-control";
			$this->_2_3_R->EditCustomAttributes = "";
			$this->_2_3_R->EditValue = HtmlEncode($this->_2_3_R->CurrentValue);
			$this->_2_3_R->PlaceHolder = RemoveHtml($this->_2_3_R->caption());

			// 3_4_R
			$this->_3_4_R->EditAttrs["class"] = "form-control";
			$this->_3_4_R->EditCustomAttributes = "";
			$this->_3_4_R->EditValue = HtmlEncode($this->_3_4_R->CurrentValue);
			$this->_3_4_R->PlaceHolder = RemoveHtml($this->_3_4_R->caption());

			// 4_5_R
			$this->_4_5_R->EditAttrs["class"] = "form-control";
			$this->_4_5_R->EditCustomAttributes = "";
			$this->_4_5_R->EditValue = HtmlEncode($this->_4_5_R->CurrentValue);
			$this->_4_5_R->PlaceHolder = RemoveHtml($this->_4_5_R->caption());

			// 4_6_R
			$this->_4_6_R->EditAttrs["class"] = "form-control";
			$this->_4_6_R->EditCustomAttributes = "";
			$this->_4_6_R->EditValue = HtmlEncode($this->_4_6_R->CurrentValue);
			$this->_4_6_R->PlaceHolder = RemoveHtml($this->_4_6_R->caption());

			// 4_7_R
			$this->_4_7_R->EditAttrs["class"] = "form-control";
			$this->_4_7_R->EditCustomAttributes = "";
			$this->_4_7_R->EditValue = HtmlEncode($this->_4_7_R->CurrentValue);
			$this->_4_7_R->PlaceHolder = RemoveHtml($this->_4_7_R->caption());

			// 4_8_R
			$this->_4_8_R->EditAttrs["class"] = "form-control";
			$this->_4_8_R->EditCustomAttributes = "";
			$this->_4_8_R->EditValue = HtmlEncode($this->_4_8_R->CurrentValue);
			$this->_4_8_R->PlaceHolder = RemoveHtml($this->_4_8_R->caption());

			// 5_9_R
			$this->_5_9_R->EditAttrs["class"] = "form-control";
			$this->_5_9_R->EditCustomAttributes = "";
			$this->_5_9_R->EditValue = HtmlEncode($this->_5_9_R->CurrentValue);
			$this->_5_9_R->PlaceHolder = RemoveHtml($this->_5_9_R->caption());

			// 5_10_R
			$this->_5_10_R->EditAttrs["class"] = "form-control";
			$this->_5_10_R->EditCustomAttributes = "";
			$this->_5_10_R->EditValue = HtmlEncode($this->_5_10_R->CurrentValue);
			$this->_5_10_R->PlaceHolder = RemoveHtml($this->_5_10_R->caption());

			// 5_11_R
			$this->_5_11_R->EditAttrs["class"] = "form-control";
			$this->_5_11_R->EditCustomAttributes = "";
			$this->_5_11_R->EditValue = HtmlEncode($this->_5_11_R->CurrentValue);
			$this->_5_11_R->PlaceHolder = RemoveHtml($this->_5_11_R->caption());

			// 5_12_R
			$this->_5_12_R->EditAttrs["class"] = "form-control";
			$this->_5_12_R->EditCustomAttributes = "";
			$this->_5_12_R->EditValue = HtmlEncode($this->_5_12_R->CurrentValue);
			$this->_5_12_R->PlaceHolder = RemoveHtml($this->_5_12_R->caption());

			// 5_13_R
			$this->_5_13_R->EditAttrs["class"] = "form-control";
			$this->_5_13_R->EditCustomAttributes = "";
			$this->_5_13_R->EditValue = HtmlEncode($this->_5_13_R->CurrentValue);
			$this->_5_13_R->PlaceHolder = RemoveHtml($this->_5_13_R->caption());

			// 5_14_R
			$this->_5_14_R->EditAttrs["class"] = "form-control";
			$this->_5_14_R->EditCustomAttributes = "";
			$this->_5_14_R->EditValue = HtmlEncode($this->_5_14_R->CurrentValue);
			$this->_5_14_R->PlaceHolder = RemoveHtml($this->_5_14_R->caption());

			// 5_51_R
			$this->_5_51_R->EditAttrs["class"] = "form-control";
			$this->_5_51_R->EditCustomAttributes = "";
			$this->_5_51_R->EditValue = HtmlEncode($this->_5_51_R->CurrentValue);
			$this->_5_51_R->PlaceHolder = RemoveHtml($this->_5_51_R->caption());

			// 6_15_R
			$this->_6_15_R->EditAttrs["class"] = "form-control";
			$this->_6_15_R->EditCustomAttributes = "";
			$this->_6_15_R->EditValue = HtmlEncode($this->_6_15_R->CurrentValue);
			$this->_6_15_R->PlaceHolder = RemoveHtml($this->_6_15_R->caption());

			// 6_16_R
			$this->_6_16_R->EditAttrs["class"] = "form-control";
			$this->_6_16_R->EditCustomAttributes = "";
			$this->_6_16_R->EditValue = HtmlEncode($this->_6_16_R->CurrentValue);
			$this->_6_16_R->PlaceHolder = RemoveHtml($this->_6_16_R->caption());

			// 6_17_R
			$this->_6_17_R->EditAttrs["class"] = "form-control";
			$this->_6_17_R->EditCustomAttributes = "";
			$this->_6_17_R->EditValue = HtmlEncode($this->_6_17_R->CurrentValue);
			$this->_6_17_R->PlaceHolder = RemoveHtml($this->_6_17_R->caption());

			// 6_18_R
			$this->_6_18_R->EditAttrs["class"] = "form-control";
			$this->_6_18_R->EditCustomAttributes = "";
			$this->_6_18_R->EditValue = HtmlEncode($this->_6_18_R->CurrentValue);
			$this->_6_18_R->PlaceHolder = RemoveHtml($this->_6_18_R->caption());

			// 6_19_R
			$this->_6_19_R->EditAttrs["class"] = "form-control";
			$this->_6_19_R->EditCustomAttributes = "";
			$this->_6_19_R->EditValue = HtmlEncode($this->_6_19_R->CurrentValue);
			$this->_6_19_R->PlaceHolder = RemoveHtml($this->_6_19_R->caption());

			// 6_20_R
			$this->_6_20_R->EditAttrs["class"] = "form-control";
			$this->_6_20_R->EditCustomAttributes = "";
			$this->_6_20_R->EditValue = HtmlEncode($this->_6_20_R->CurrentValue);
			$this->_6_20_R->PlaceHolder = RemoveHtml($this->_6_20_R->caption());

			// 6_52_R
			$this->_6_52_R->EditAttrs["class"] = "form-control";
			$this->_6_52_R->EditCustomAttributes = "";
			$this->_6_52_R->EditValue = HtmlEncode($this->_6_52_R->CurrentValue);
			$this->_6_52_R->PlaceHolder = RemoveHtml($this->_6_52_R->caption());

			// 7_21_R
			$this->_7_21_R->EditAttrs["class"] = "form-control";
			$this->_7_21_R->EditCustomAttributes = "";
			$this->_7_21_R->EditValue = HtmlEncode($this->_7_21_R->CurrentValue);
			$this->_7_21_R->PlaceHolder = RemoveHtml($this->_7_21_R->caption());

			// 8_22_R
			$this->_8_22_R->EditAttrs["class"] = "form-control";
			$this->_8_22_R->EditCustomAttributes = "";
			$this->_8_22_R->EditValue = HtmlEncode($this->_8_22_R->CurrentValue);
			$this->_8_22_R->PlaceHolder = RemoveHtml($this->_8_22_R->caption());

			// 8_23_R
			$this->_8_23_R->EditAttrs["class"] = "form-control";
			$this->_8_23_R->EditCustomAttributes = "";
			$this->_8_23_R->EditValue = HtmlEncode($this->_8_23_R->CurrentValue);
			$this->_8_23_R->PlaceHolder = RemoveHtml($this->_8_23_R->caption());

			// 8_24_R
			$this->_8_24_R->EditAttrs["class"] = "form-control";
			$this->_8_24_R->EditCustomAttributes = "";
			$this->_8_24_R->EditValue = HtmlEncode($this->_8_24_R->CurrentValue);
			$this->_8_24_R->PlaceHolder = RemoveHtml($this->_8_24_R->caption());

			// 8_25_R
			$this->_8_25_R->EditAttrs["class"] = "form-control";
			$this->_8_25_R->EditCustomAttributes = "";
			$this->_8_25_R->EditValue = HtmlEncode($this->_8_25_R->CurrentValue);
			$this->_8_25_R->PlaceHolder = RemoveHtml($this->_8_25_R->caption());

			// 9_26_R
			$this->_9_26_R->EditAttrs["class"] = "form-control";
			$this->_9_26_R->EditCustomAttributes = "";
			$this->_9_26_R->EditValue = HtmlEncode($this->_9_26_R->CurrentValue);
			$this->_9_26_R->PlaceHolder = RemoveHtml($this->_9_26_R->caption());

			// 9_27_R
			$this->_9_27_R->EditAttrs["class"] = "form-control";
			$this->_9_27_R->EditCustomAttributes = "";
			$this->_9_27_R->EditValue = HtmlEncode($this->_9_27_R->CurrentValue);
			$this->_9_27_R->PlaceHolder = RemoveHtml($this->_9_27_R->caption());

			// 9_28_R
			$this->_9_28_R->EditAttrs["class"] = "form-control";
			$this->_9_28_R->EditCustomAttributes = "";
			$this->_9_28_R->EditValue = HtmlEncode($this->_9_28_R->CurrentValue);
			$this->_9_28_R->PlaceHolder = RemoveHtml($this->_9_28_R->caption());

			// 9_29_R
			$this->_9_29_R->EditAttrs["class"] = "form-control";
			$this->_9_29_R->EditCustomAttributes = "";
			$this->_9_29_R->EditValue = HtmlEncode($this->_9_29_R->CurrentValue);
			$this->_9_29_R->PlaceHolder = RemoveHtml($this->_9_29_R->caption());

			// 9_30_R
			$this->_9_30_R->EditAttrs["class"] = "form-control";
			$this->_9_30_R->EditCustomAttributes = "";
			$this->_9_30_R->EditValue = HtmlEncode($this->_9_30_R->CurrentValue);
			$this->_9_30_R->PlaceHolder = RemoveHtml($this->_9_30_R->caption());

			// 9_31_R
			$this->_9_31_R->EditAttrs["class"] = "form-control";
			$this->_9_31_R->EditCustomAttributes = "";
			$this->_9_31_R->EditValue = HtmlEncode($this->_9_31_R->CurrentValue);
			$this->_9_31_R->PlaceHolder = RemoveHtml($this->_9_31_R->caption());

			// 9_32_R
			$this->_9_32_R->EditAttrs["class"] = "form-control";
			$this->_9_32_R->EditCustomAttributes = "";
			$this->_9_32_R->EditValue = HtmlEncode($this->_9_32_R->CurrentValue);
			$this->_9_32_R->PlaceHolder = RemoveHtml($this->_9_32_R->caption());

			// 9_33_R
			$this->_9_33_R->EditAttrs["class"] = "form-control";
			$this->_9_33_R->EditCustomAttributes = "";
			$this->_9_33_R->EditValue = HtmlEncode($this->_9_33_R->CurrentValue);
			$this->_9_33_R->PlaceHolder = RemoveHtml($this->_9_33_R->caption());

			// 9_34_R
			$this->_9_34_R->EditAttrs["class"] = "form-control";
			$this->_9_34_R->EditCustomAttributes = "";
			$this->_9_34_R->EditValue = HtmlEncode($this->_9_34_R->CurrentValue);
			$this->_9_34_R->PlaceHolder = RemoveHtml($this->_9_34_R->caption());

			// 9_35_R
			$this->_9_35_R->EditAttrs["class"] = "form-control";
			$this->_9_35_R->EditCustomAttributes = "";
			$this->_9_35_R->EditValue = HtmlEncode($this->_9_35_R->CurrentValue);
			$this->_9_35_R->PlaceHolder = RemoveHtml($this->_9_35_R->caption());

			// 9_36_R
			$this->_9_36_R->EditAttrs["class"] = "form-control";
			$this->_9_36_R->EditCustomAttributes = "";
			$this->_9_36_R->EditValue = HtmlEncode($this->_9_36_R->CurrentValue);
			$this->_9_36_R->PlaceHolder = RemoveHtml($this->_9_36_R->caption());

			// 9_37_R
			$this->_9_37_R->EditAttrs["class"] = "form-control";
			$this->_9_37_R->EditCustomAttributes = "";
			$this->_9_37_R->EditValue = HtmlEncode($this->_9_37_R->CurrentValue);
			$this->_9_37_R->PlaceHolder = RemoveHtml($this->_9_37_R->caption());

			// 9_38_R
			$this->_9_38_R->EditAttrs["class"] = "form-control";
			$this->_9_38_R->EditCustomAttributes = "";
			$this->_9_38_R->EditValue = HtmlEncode($this->_9_38_R->CurrentValue);
			$this->_9_38_R->PlaceHolder = RemoveHtml($this->_9_38_R->caption());

			// 9_39_R
			$this->_9_39_R->EditAttrs["class"] = "form-control";
			$this->_9_39_R->EditCustomAttributes = "";
			$this->_9_39_R->EditValue = HtmlEncode($this->_9_39_R->CurrentValue);
			$this->_9_39_R->PlaceHolder = RemoveHtml($this->_9_39_R->caption());

			// 10_40_R
			$this->_10_40_R->EditAttrs["class"] = "form-control";
			$this->_10_40_R->EditCustomAttributes = "";
			$this->_10_40_R->EditValue = HtmlEncode($this->_10_40_R->CurrentValue);
			$this->_10_40_R->PlaceHolder = RemoveHtml($this->_10_40_R->caption());

			// 10_41_R
			$this->_10_41_R->EditAttrs["class"] = "form-control";
			$this->_10_41_R->EditCustomAttributes = "";
			$this->_10_41_R->EditValue = HtmlEncode($this->_10_41_R->CurrentValue);
			$this->_10_41_R->PlaceHolder = RemoveHtml($this->_10_41_R->caption());

			// 11_42_R
			$this->_11_42_R->EditAttrs["class"] = "form-control";
			$this->_11_42_R->EditCustomAttributes = "";
			$this->_11_42_R->EditValue = HtmlEncode($this->_11_42_R->CurrentValue);
			$this->_11_42_R->PlaceHolder = RemoveHtml($this->_11_42_R->caption());

			// 11_43_R
			$this->_11_43_R->EditAttrs["class"] = "form-control";
			$this->_11_43_R->EditCustomAttributes = "";
			$this->_11_43_R->EditValue = HtmlEncode($this->_11_43_R->CurrentValue);
			$this->_11_43_R->PlaceHolder = RemoveHtml($this->_11_43_R->caption());

			// 12_44_R
			$this->_12_44_R->EditAttrs["class"] = "form-control";
			$this->_12_44_R->EditCustomAttributes = "";
			$this->_12_44_R->EditValue = HtmlEncode($this->_12_44_R->CurrentValue);
			$this->_12_44_R->PlaceHolder = RemoveHtml($this->_12_44_R->caption());

			// 12_45_R
			$this->_12_45_R->EditAttrs["class"] = "form-control";
			$this->_12_45_R->EditCustomAttributes = "";
			$this->_12_45_R->EditValue = HtmlEncode($this->_12_45_R->CurrentValue);
			$this->_12_45_R->PlaceHolder = RemoveHtml($this->_12_45_R->caption());

			// 12_46_R
			$this->_12_46_R->EditAttrs["class"] = "form-control";
			$this->_12_46_R->EditCustomAttributes = "";
			$this->_12_46_R->EditValue = HtmlEncode($this->_12_46_R->CurrentValue);
			$this->_12_46_R->PlaceHolder = RemoveHtml($this->_12_46_R->caption());

			// 12_47_R
			$this->_12_47_R->EditAttrs["class"] = "form-control";
			$this->_12_47_R->EditCustomAttributes = "";
			$this->_12_47_R->EditValue = HtmlEncode($this->_12_47_R->CurrentValue);
			$this->_12_47_R->PlaceHolder = RemoveHtml($this->_12_47_R->caption());

			// 12_48_R
			$this->_12_48_R->EditAttrs["class"] = "form-control";
			$this->_12_48_R->EditCustomAttributes = "";
			$this->_12_48_R->EditValue = HtmlEncode($this->_12_48_R->CurrentValue);
			$this->_12_48_R->PlaceHolder = RemoveHtml($this->_12_48_R->caption());

			// 12_49_R
			$this->_12_49_R->EditAttrs["class"] = "form-control";
			$this->_12_49_R->EditCustomAttributes = "";
			$this->_12_49_R->EditValue = HtmlEncode($this->_12_49_R->CurrentValue);
			$this->_12_49_R->PlaceHolder = RemoveHtml($this->_12_49_R->caption());

			// 12_50_R
			$this->_12_50_R->EditAttrs["class"] = "form-control";
			$this->_12_50_R->EditCustomAttributes = "";
			$this->_12_50_R->EditValue = HtmlEncode($this->_12_50_R->CurrentValue);
			$this->_12_50_R->PlaceHolder = RemoveHtml($this->_12_50_R->caption());

			// 1__R
			$this->_1__R->EditAttrs["class"] = "form-control";
			$this->_1__R->EditCustomAttributes = "";
			$this->_1__R->EditValue = HtmlEncode($this->_1__R->CurrentValue);
			$this->_1__R->PlaceHolder = RemoveHtml($this->_1__R->caption());

			// 13_54_R
			$this->_13_54_R->EditAttrs["class"] = "form-control";
			$this->_13_54_R->EditCustomAttributes = "";
			$this->_13_54_R->EditValue = HtmlEncode($this->_13_54_R->CurrentValue);
			$this->_13_54_R->PlaceHolder = RemoveHtml($this->_13_54_R->caption());

			// 13_54_1_R
			$this->_13_54_1_R->EditAttrs["class"] = "form-control";
			$this->_13_54_1_R->EditCustomAttributes = "";
			$this->_13_54_1_R->EditValue = HtmlEncode($this->_13_54_1_R->CurrentValue);
			$this->_13_54_1_R->PlaceHolder = RemoveHtml($this->_13_54_1_R->caption());

			// 13_54_2_R
			$this->_13_54_2_R->EditAttrs["class"] = "form-control";
			$this->_13_54_2_R->EditCustomAttributes = "";
			$this->_13_54_2_R->EditValue = HtmlEncode($this->_13_54_2_R->CurrentValue);
			$this->_13_54_2_R->PlaceHolder = RemoveHtml($this->_13_54_2_R->caption());

			// 13_55_R
			$this->_13_55_R->EditAttrs["class"] = "form-control";
			$this->_13_55_R->EditCustomAttributes = "";
			$this->_13_55_R->EditValue = HtmlEncode($this->_13_55_R->CurrentValue);
			$this->_13_55_R->PlaceHolder = RemoveHtml($this->_13_55_R->caption());

			// 13_55_1_R
			$this->_13_55_1_R->EditAttrs["class"] = "form-control";
			$this->_13_55_1_R->EditCustomAttributes = "";
			$this->_13_55_1_R->EditValue = HtmlEncode($this->_13_55_1_R->CurrentValue);
			$this->_13_55_1_R->PlaceHolder = RemoveHtml($this->_13_55_1_R->caption());

			// 13_55_2_R
			$this->_13_55_2_R->EditAttrs["class"] = "form-control";
			$this->_13_55_2_R->EditCustomAttributes = "";
			$this->_13_55_2_R->EditValue = HtmlEncode($this->_13_55_2_R->CurrentValue);
			$this->_13_55_2_R->PlaceHolder = RemoveHtml($this->_13_55_2_R->caption());

			// 13_56_R
			$this->_13_56_R->EditAttrs["class"] = "form-control";
			$this->_13_56_R->EditCustomAttributes = "";
			$this->_13_56_R->EditValue = HtmlEncode($this->_13_56_R->CurrentValue);
			$this->_13_56_R->PlaceHolder = RemoveHtml($this->_13_56_R->caption());

			// 13_56_1_R
			$this->_13_56_1_R->EditAttrs["class"] = "form-control";
			$this->_13_56_1_R->EditCustomAttributes = "";
			$this->_13_56_1_R->EditValue = HtmlEncode($this->_13_56_1_R->CurrentValue);
			$this->_13_56_1_R->PlaceHolder = RemoveHtml($this->_13_56_1_R->caption());

			// 13_56_2_R
			$this->_13_56_2_R->EditAttrs["class"] = "form-control";
			$this->_13_56_2_R->EditCustomAttributes = "";
			$this->_13_56_2_R->EditValue = HtmlEncode($this->_13_56_2_R->CurrentValue);
			$this->_13_56_2_R->PlaceHolder = RemoveHtml($this->_13_56_2_R->caption());

			// 12_53_R
			$this->_12_53_R->EditAttrs["class"] = "form-control";
			$this->_12_53_R->EditCustomAttributes = "";
			$this->_12_53_R->EditValue = HtmlEncode($this->_12_53_R->CurrentValue);
			$this->_12_53_R->PlaceHolder = RemoveHtml($this->_12_53_R->caption());

			// 12_53_1_R
			$this->_12_53_1_R->EditAttrs["class"] = "form-control";
			$this->_12_53_1_R->EditCustomAttributes = "";
			$this->_12_53_1_R->EditValue = HtmlEncode($this->_12_53_1_R->CurrentValue);
			$this->_12_53_1_R->PlaceHolder = RemoveHtml($this->_12_53_1_R->caption());

			// 12_53_2_R
			$this->_12_53_2_R->EditAttrs["class"] = "form-control";
			$this->_12_53_2_R->EditCustomAttributes = "";
			$this->_12_53_2_R->EditValue = HtmlEncode($this->_12_53_2_R->CurrentValue);
			$this->_12_53_2_R->PlaceHolder = RemoveHtml($this->_12_53_2_R->caption());

			// 12_53_3_R
			$this->_12_53_3_R->EditAttrs["class"] = "form-control";
			$this->_12_53_3_R->EditCustomAttributes = "";
			$this->_12_53_3_R->EditValue = HtmlEncode($this->_12_53_3_R->CurrentValue);
			$this->_12_53_3_R->PlaceHolder = RemoveHtml($this->_12_53_3_R->caption());

			// 12_53_4_R
			$this->_12_53_4_R->EditAttrs["class"] = "form-control";
			$this->_12_53_4_R->EditCustomAttributes = "";
			$this->_12_53_4_R->EditValue = HtmlEncode($this->_12_53_4_R->CurrentValue);
			$this->_12_53_4_R->PlaceHolder = RemoveHtml($this->_12_53_4_R->caption());

			// 12_53_5_R
			$this->_12_53_5_R->EditAttrs["class"] = "form-control";
			$this->_12_53_5_R->EditCustomAttributes = "";
			$this->_12_53_5_R->EditValue = HtmlEncode($this->_12_53_5_R->CurrentValue);
			$this->_12_53_5_R->PlaceHolder = RemoveHtml($this->_12_53_5_R->caption());

			// 12_53_6_R
			$this->_12_53_6_R->EditAttrs["class"] = "form-control";
			$this->_12_53_6_R->EditCustomAttributes = "";
			$this->_12_53_6_R->EditValue = HtmlEncode($this->_12_53_6_R->CurrentValue);
			$this->_12_53_6_R->PlaceHolder = RemoveHtml($this->_12_53_6_R->caption());

			// 13_57_R
			$this->_13_57_R->EditAttrs["class"] = "form-control";
			$this->_13_57_R->EditCustomAttributes = "";
			$this->_13_57_R->EditValue = HtmlEncode($this->_13_57_R->CurrentValue);
			$this->_13_57_R->PlaceHolder = RemoveHtml($this->_13_57_R->caption());

			// 13_57_1_R
			$this->_13_57_1_R->EditAttrs["class"] = "form-control";
			$this->_13_57_1_R->EditCustomAttributes = "";
			$this->_13_57_1_R->EditValue = HtmlEncode($this->_13_57_1_R->CurrentValue);
			$this->_13_57_1_R->PlaceHolder = RemoveHtml($this->_13_57_1_R->caption());

			// 13_57_2_R
			$this->_13_57_2_R->EditAttrs["class"] = "form-control";
			$this->_13_57_2_R->EditCustomAttributes = "";
			$this->_13_57_2_R->EditValue = HtmlEncode($this->_13_57_2_R->CurrentValue);
			$this->_13_57_2_R->PlaceHolder = RemoveHtml($this->_13_57_2_R->caption());

			// 13_58_R
			$this->_13_58_R->EditAttrs["class"] = "form-control";
			$this->_13_58_R->EditCustomAttributes = "";
			$this->_13_58_R->EditValue = HtmlEncode($this->_13_58_R->CurrentValue);
			$this->_13_58_R->PlaceHolder = RemoveHtml($this->_13_58_R->caption());

			// 13_58_1_R
			$this->_13_58_1_R->EditAttrs["class"] = "form-control";
			$this->_13_58_1_R->EditCustomAttributes = "";
			$this->_13_58_1_R->EditValue = HtmlEncode($this->_13_58_1_R->CurrentValue);
			$this->_13_58_1_R->PlaceHolder = RemoveHtml($this->_13_58_1_R->caption());

			// 13_58_2_R
			$this->_13_58_2_R->EditAttrs["class"] = "form-control";
			$this->_13_58_2_R->EditCustomAttributes = "";
			$this->_13_58_2_R->EditValue = HtmlEncode($this->_13_58_2_R->CurrentValue);
			$this->_13_58_2_R->PlaceHolder = RemoveHtml($this->_13_58_2_R->caption());

			// 13_59_R
			$this->_13_59_R->EditAttrs["class"] = "form-control";
			$this->_13_59_R->EditCustomAttributes = "";
			$this->_13_59_R->EditValue = HtmlEncode($this->_13_59_R->CurrentValue);
			$this->_13_59_R->PlaceHolder = RemoveHtml($this->_13_59_R->caption());

			// 13_59_1_R
			$this->_13_59_1_R->EditAttrs["class"] = "form-control";
			$this->_13_59_1_R->EditCustomAttributes = "";
			$this->_13_59_1_R->EditValue = HtmlEncode($this->_13_59_1_R->CurrentValue);
			$this->_13_59_1_R->PlaceHolder = RemoveHtml($this->_13_59_1_R->caption());

			// 13_59_2_R
			$this->_13_59_2_R->EditAttrs["class"] = "form-control";
			$this->_13_59_2_R->EditCustomAttributes = "";
			$this->_13_59_2_R->EditValue = HtmlEncode($this->_13_59_2_R->CurrentValue);
			$this->_13_59_2_R->PlaceHolder = RemoveHtml($this->_13_59_2_R->caption());

			// 13_60_R
			$this->_13_60_R->EditAttrs["class"] = "form-control";
			$this->_13_60_R->EditCustomAttributes = "";
			$this->_13_60_R->EditValue = HtmlEncode($this->_13_60_R->CurrentValue);
			$this->_13_60_R->PlaceHolder = RemoveHtml($this->_13_60_R->caption());

			// 12_53_7_R
			$this->_12_53_7_R->EditAttrs["class"] = "form-control";
			$this->_12_53_7_R->EditCustomAttributes = "";
			$this->_12_53_7_R->EditValue = HtmlEncode($this->_12_53_7_R->CurrentValue);
			$this->_12_53_7_R->PlaceHolder = RemoveHtml($this->_12_53_7_R->caption());

			// 12_53_8_R
			$this->_12_53_8_R->EditAttrs["class"] = "form-control";
			$this->_12_53_8_R->EditCustomAttributes = "";
			$this->_12_53_8_R->EditValue = HtmlEncode($this->_12_53_8_R->CurrentValue);
			$this->_12_53_8_R->PlaceHolder = RemoveHtml($this->_12_53_8_R->caption());

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// fecha
			$this->fecha->LinkCustomAttributes = "";
			$this->fecha->HrefValue = "";

			// hora
			$this->hora->LinkCustomAttributes = "";
			$this->hora->HrefValue = "";

			// audio
			$this->audio->LinkCustomAttributes = "";
			$this->audio->HrefValue = "";

			// st
			$this->st->LinkCustomAttributes = "";
			$this->st->HrefValue = "";

			// fechaHoraIni
			$this->fechaHoraIni->LinkCustomAttributes = "";
			$this->fechaHoraIni->HrefValue = "";

			// fechaHoraFin
			$this->fechaHoraFin->LinkCustomAttributes = "";
			$this->fechaHoraFin->HrefValue = "";

			// telefono
			$this->telefono->LinkCustomAttributes = "";
			$this->telefono->HrefValue = "";

			// agente
			$this->agente->LinkCustomAttributes = "";
			$this->agente->HrefValue = "";

			// fechabo
			$this->fechabo->LinkCustomAttributes = "";
			$this->fechabo->HrefValue = "";

			// agentebo
			$this->agentebo->LinkCustomAttributes = "";
			$this->agentebo->HrefValue = "";

			// comentariosbo
			$this->comentariosbo->LinkCustomAttributes = "";
			$this->comentariosbo->HrefValue = "";

			// IP
			$this->IP->LinkCustomAttributes = "";
			$this->IP->HrefValue = "";

			// actual
			$this->actual->LinkCustomAttributes = "";
			$this->actual->HrefValue = "";

			// completado
			$this->completado->LinkCustomAttributes = "";
			$this->completado->HrefValue = "";

			// 2_1_R
			$this->_2_1_R->LinkCustomAttributes = "";
			$this->_2_1_R->HrefValue = "";

			// 2_2_R
			$this->_2_2_R->LinkCustomAttributes = "";
			$this->_2_2_R->HrefValue = "";

			// 2_3_R
			$this->_2_3_R->LinkCustomAttributes = "";
			$this->_2_3_R->HrefValue = "";

			// 3_4_R
			$this->_3_4_R->LinkCustomAttributes = "";
			$this->_3_4_R->HrefValue = "";

			// 4_5_R
			$this->_4_5_R->LinkCustomAttributes = "";
			$this->_4_5_R->HrefValue = "";

			// 4_6_R
			$this->_4_6_R->LinkCustomAttributes = "";
			$this->_4_6_R->HrefValue = "";

			// 4_7_R
			$this->_4_7_R->LinkCustomAttributes = "";
			$this->_4_7_R->HrefValue = "";

			// 4_8_R
			$this->_4_8_R->LinkCustomAttributes = "";
			$this->_4_8_R->HrefValue = "";

			// 5_9_R
			$this->_5_9_R->LinkCustomAttributes = "";
			$this->_5_9_R->HrefValue = "";

			// 5_10_R
			$this->_5_10_R->LinkCustomAttributes = "";
			$this->_5_10_R->HrefValue = "";

			// 5_11_R
			$this->_5_11_R->LinkCustomAttributes = "";
			$this->_5_11_R->HrefValue = "";

			// 5_12_R
			$this->_5_12_R->LinkCustomAttributes = "";
			$this->_5_12_R->HrefValue = "";

			// 5_13_R
			$this->_5_13_R->LinkCustomAttributes = "";
			$this->_5_13_R->HrefValue = "";

			// 5_14_R
			$this->_5_14_R->LinkCustomAttributes = "";
			$this->_5_14_R->HrefValue = "";

			// 5_51_R
			$this->_5_51_R->LinkCustomAttributes = "";
			$this->_5_51_R->HrefValue = "";

			// 6_15_R
			$this->_6_15_R->LinkCustomAttributes = "";
			$this->_6_15_R->HrefValue = "";

			// 6_16_R
			$this->_6_16_R->LinkCustomAttributes = "";
			$this->_6_16_R->HrefValue = "";

			// 6_17_R
			$this->_6_17_R->LinkCustomAttributes = "";
			$this->_6_17_R->HrefValue = "";

			// 6_18_R
			$this->_6_18_R->LinkCustomAttributes = "";
			$this->_6_18_R->HrefValue = "";

			// 6_19_R
			$this->_6_19_R->LinkCustomAttributes = "";
			$this->_6_19_R->HrefValue = "";

			// 6_20_R
			$this->_6_20_R->LinkCustomAttributes = "";
			$this->_6_20_R->HrefValue = "";

			// 6_52_R
			$this->_6_52_R->LinkCustomAttributes = "";
			$this->_6_52_R->HrefValue = "";

			// 7_21_R
			$this->_7_21_R->LinkCustomAttributes = "";
			$this->_7_21_R->HrefValue = "";

			// 8_22_R
			$this->_8_22_R->LinkCustomAttributes = "";
			$this->_8_22_R->HrefValue = "";

			// 8_23_R
			$this->_8_23_R->LinkCustomAttributes = "";
			$this->_8_23_R->HrefValue = "";

			// 8_24_R
			$this->_8_24_R->LinkCustomAttributes = "";
			$this->_8_24_R->HrefValue = "";

			// 8_25_R
			$this->_8_25_R->LinkCustomAttributes = "";
			$this->_8_25_R->HrefValue = "";

			// 9_26_R
			$this->_9_26_R->LinkCustomAttributes = "";
			$this->_9_26_R->HrefValue = "";

			// 9_27_R
			$this->_9_27_R->LinkCustomAttributes = "";
			$this->_9_27_R->HrefValue = "";

			// 9_28_R
			$this->_9_28_R->LinkCustomAttributes = "";
			$this->_9_28_R->HrefValue = "";

			// 9_29_R
			$this->_9_29_R->LinkCustomAttributes = "";
			$this->_9_29_R->HrefValue = "";

			// 9_30_R
			$this->_9_30_R->LinkCustomAttributes = "";
			$this->_9_30_R->HrefValue = "";

			// 9_31_R
			$this->_9_31_R->LinkCustomAttributes = "";
			$this->_9_31_R->HrefValue = "";

			// 9_32_R
			$this->_9_32_R->LinkCustomAttributes = "";
			$this->_9_32_R->HrefValue = "";

			// 9_33_R
			$this->_9_33_R->LinkCustomAttributes = "";
			$this->_9_33_R->HrefValue = "";

			// 9_34_R
			$this->_9_34_R->LinkCustomAttributes = "";
			$this->_9_34_R->HrefValue = "";

			// 9_35_R
			$this->_9_35_R->LinkCustomAttributes = "";
			$this->_9_35_R->HrefValue = "";

			// 9_36_R
			$this->_9_36_R->LinkCustomAttributes = "";
			$this->_9_36_R->HrefValue = "";

			// 9_37_R
			$this->_9_37_R->LinkCustomAttributes = "";
			$this->_9_37_R->HrefValue = "";

			// 9_38_R
			$this->_9_38_R->LinkCustomAttributes = "";
			$this->_9_38_R->HrefValue = "";

			// 9_39_R
			$this->_9_39_R->LinkCustomAttributes = "";
			$this->_9_39_R->HrefValue = "";

			// 10_40_R
			$this->_10_40_R->LinkCustomAttributes = "";
			$this->_10_40_R->HrefValue = "";

			// 10_41_R
			$this->_10_41_R->LinkCustomAttributes = "";
			$this->_10_41_R->HrefValue = "";

			// 11_42_R
			$this->_11_42_R->LinkCustomAttributes = "";
			$this->_11_42_R->HrefValue = "";

			// 11_43_R
			$this->_11_43_R->LinkCustomAttributes = "";
			$this->_11_43_R->HrefValue = "";

			// 12_44_R
			$this->_12_44_R->LinkCustomAttributes = "";
			$this->_12_44_R->HrefValue = "";

			// 12_45_R
			$this->_12_45_R->LinkCustomAttributes = "";
			$this->_12_45_R->HrefValue = "";

			// 12_46_R
			$this->_12_46_R->LinkCustomAttributes = "";
			$this->_12_46_R->HrefValue = "";

			// 12_47_R
			$this->_12_47_R->LinkCustomAttributes = "";
			$this->_12_47_R->HrefValue = "";

			// 12_48_R
			$this->_12_48_R->LinkCustomAttributes = "";
			$this->_12_48_R->HrefValue = "";

			// 12_49_R
			$this->_12_49_R->LinkCustomAttributes = "";
			$this->_12_49_R->HrefValue = "";

			// 12_50_R
			$this->_12_50_R->LinkCustomAttributes = "";
			$this->_12_50_R->HrefValue = "";

			// 1__R
			$this->_1__R->LinkCustomAttributes = "";
			$this->_1__R->HrefValue = "";

			// 13_54_R
			$this->_13_54_R->LinkCustomAttributes = "";
			$this->_13_54_R->HrefValue = "";

			// 13_54_1_R
			$this->_13_54_1_R->LinkCustomAttributes = "";
			$this->_13_54_1_R->HrefValue = "";

			// 13_54_2_R
			$this->_13_54_2_R->LinkCustomAttributes = "";
			$this->_13_54_2_R->HrefValue = "";

			// 13_55_R
			$this->_13_55_R->LinkCustomAttributes = "";
			$this->_13_55_R->HrefValue = "";

			// 13_55_1_R
			$this->_13_55_1_R->LinkCustomAttributes = "";
			$this->_13_55_1_R->HrefValue = "";

			// 13_55_2_R
			$this->_13_55_2_R->LinkCustomAttributes = "";
			$this->_13_55_2_R->HrefValue = "";

			// 13_56_R
			$this->_13_56_R->LinkCustomAttributes = "";
			$this->_13_56_R->HrefValue = "";

			// 13_56_1_R
			$this->_13_56_1_R->LinkCustomAttributes = "";
			$this->_13_56_1_R->HrefValue = "";

			// 13_56_2_R
			$this->_13_56_2_R->LinkCustomAttributes = "";
			$this->_13_56_2_R->HrefValue = "";

			// 12_53_R
			$this->_12_53_R->LinkCustomAttributes = "";
			$this->_12_53_R->HrefValue = "";

			// 12_53_1_R
			$this->_12_53_1_R->LinkCustomAttributes = "";
			$this->_12_53_1_R->HrefValue = "";

			// 12_53_2_R
			$this->_12_53_2_R->LinkCustomAttributes = "";
			$this->_12_53_2_R->HrefValue = "";

			// 12_53_3_R
			$this->_12_53_3_R->LinkCustomAttributes = "";
			$this->_12_53_3_R->HrefValue = "";

			// 12_53_4_R
			$this->_12_53_4_R->LinkCustomAttributes = "";
			$this->_12_53_4_R->HrefValue = "";

			// 12_53_5_R
			$this->_12_53_5_R->LinkCustomAttributes = "";
			$this->_12_53_5_R->HrefValue = "";

			// 12_53_6_R
			$this->_12_53_6_R->LinkCustomAttributes = "";
			$this->_12_53_6_R->HrefValue = "";

			// 13_57_R
			$this->_13_57_R->LinkCustomAttributes = "";
			$this->_13_57_R->HrefValue = "";

			// 13_57_1_R
			$this->_13_57_1_R->LinkCustomAttributes = "";
			$this->_13_57_1_R->HrefValue = "";

			// 13_57_2_R
			$this->_13_57_2_R->LinkCustomAttributes = "";
			$this->_13_57_2_R->HrefValue = "";

			// 13_58_R
			$this->_13_58_R->LinkCustomAttributes = "";
			$this->_13_58_R->HrefValue = "";

			// 13_58_1_R
			$this->_13_58_1_R->LinkCustomAttributes = "";
			$this->_13_58_1_R->HrefValue = "";

			// 13_58_2_R
			$this->_13_58_2_R->LinkCustomAttributes = "";
			$this->_13_58_2_R->HrefValue = "";

			// 13_59_R
			$this->_13_59_R->LinkCustomAttributes = "";
			$this->_13_59_R->HrefValue = "";

			// 13_59_1_R
			$this->_13_59_1_R->LinkCustomAttributes = "";
			$this->_13_59_1_R->HrefValue = "";

			// 13_59_2_R
			$this->_13_59_2_R->LinkCustomAttributes = "";
			$this->_13_59_2_R->HrefValue = "";

			// 13_60_R
			$this->_13_60_R->LinkCustomAttributes = "";
			$this->_13_60_R->HrefValue = "";

			// 12_53_7_R
			$this->_12_53_7_R->LinkCustomAttributes = "";
			$this->_12_53_7_R->HrefValue = "";

			// 12_53_8_R
			$this->_12_53_8_R->LinkCustomAttributes = "";
			$this->_12_53_8_R->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->id->Required) {
			if (!$this->id->IsDetailKey && $this->id->FormValue != NULL && $this->id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
			}
		}
		if ($this->fecha->Required) {
			if (!$this->fecha->IsDetailKey && $this->fecha->FormValue != NULL && $this->fecha->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fecha->caption(), $this->fecha->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->fecha->FormValue)) {
			AddMessage($FormError, $this->fecha->errorMessage());
		}
		if ($this->hora->Required) {
			if (!$this->hora->IsDetailKey && $this->hora->FormValue != NULL && $this->hora->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hora->caption(), $this->hora->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->hora->FormValue)) {
			AddMessage($FormError, $this->hora->errorMessage());
		}
		if ($this->audio->Required) {
			if (!$this->audio->IsDetailKey && $this->audio->FormValue != NULL && $this->audio->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->audio->caption(), $this->audio->RequiredErrorMessage));
			}
		}
		if ($this->st->Required) {
			if (!$this->st->IsDetailKey && $this->st->FormValue != NULL && $this->st->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->st->caption(), $this->st->RequiredErrorMessage));
			}
		}
		if ($this->fechaHoraIni->Required) {
			if (!$this->fechaHoraIni->IsDetailKey && $this->fechaHoraIni->FormValue != NULL && $this->fechaHoraIni->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fechaHoraIni->caption(), $this->fechaHoraIni->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->fechaHoraIni->FormValue)) {
			AddMessage($FormError, $this->fechaHoraIni->errorMessage());
		}
		if ($this->fechaHoraFin->Required) {
			if (!$this->fechaHoraFin->IsDetailKey && $this->fechaHoraFin->FormValue != NULL && $this->fechaHoraFin->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fechaHoraFin->caption(), $this->fechaHoraFin->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->fechaHoraFin->FormValue)) {
			AddMessage($FormError, $this->fechaHoraFin->errorMessage());
		}
		if ($this->telefono->Required) {
			if (!$this->telefono->IsDetailKey && $this->telefono->FormValue != NULL && $this->telefono->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telefono->caption(), $this->telefono->RequiredErrorMessage));
			}
		}
		if ($this->agente->Required) {
			if (!$this->agente->IsDetailKey && $this->agente->FormValue != NULL && $this->agente->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->agente->caption(), $this->agente->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->agente->FormValue)) {
			AddMessage($FormError, $this->agente->errorMessage());
		}
		if ($this->fechabo->Required) {
			if (!$this->fechabo->IsDetailKey && $this->fechabo->FormValue != NULL && $this->fechabo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fechabo->caption(), $this->fechabo->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->fechabo->FormValue)) {
			AddMessage($FormError, $this->fechabo->errorMessage());
		}
		if ($this->agentebo->Required) {
			if (!$this->agentebo->IsDetailKey && $this->agentebo->FormValue != NULL && $this->agentebo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->agentebo->caption(), $this->agentebo->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->agentebo->FormValue)) {
			AddMessage($FormError, $this->agentebo->errorMessage());
		}
		if ($this->comentariosbo->Required) {
			if (!$this->comentariosbo->IsDetailKey && $this->comentariosbo->FormValue != NULL && $this->comentariosbo->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->comentariosbo->caption(), $this->comentariosbo->RequiredErrorMessage));
			}
		}
		if ($this->IP->Required) {
			if (!$this->IP->IsDetailKey && $this->IP->FormValue != NULL && $this->IP->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->IP->caption(), $this->IP->RequiredErrorMessage));
			}
		}
		if ($this->actual->Required) {
			if (!$this->actual->IsDetailKey && $this->actual->FormValue != NULL && $this->actual->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->actual->caption(), $this->actual->RequiredErrorMessage));
			}
		}
		if ($this->completado->Required) {
			if (!$this->completado->IsDetailKey && $this->completado->FormValue != NULL && $this->completado->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->completado->caption(), $this->completado->RequiredErrorMessage));
			}
		}
		if ($this->_2_1_R->Required) {
			if (!$this->_2_1_R->IsDetailKey && $this->_2_1_R->FormValue != NULL && $this->_2_1_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_2_1_R->caption(), $this->_2_1_R->RequiredErrorMessage));
			}
		}
		if ($this->_2_2_R->Required) {
			if (!$this->_2_2_R->IsDetailKey && $this->_2_2_R->FormValue != NULL && $this->_2_2_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_2_2_R->caption(), $this->_2_2_R->RequiredErrorMessage));
			}
		}
		if ($this->_2_3_R->Required) {
			if (!$this->_2_3_R->IsDetailKey && $this->_2_3_R->FormValue != NULL && $this->_2_3_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_2_3_R->caption(), $this->_2_3_R->RequiredErrorMessage));
			}
		}
		if ($this->_3_4_R->Required) {
			if (!$this->_3_4_R->IsDetailKey && $this->_3_4_R->FormValue != NULL && $this->_3_4_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_3_4_R->caption(), $this->_3_4_R->RequiredErrorMessage));
			}
		}
		if ($this->_4_5_R->Required) {
			if (!$this->_4_5_R->IsDetailKey && $this->_4_5_R->FormValue != NULL && $this->_4_5_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_4_5_R->caption(), $this->_4_5_R->RequiredErrorMessage));
			}
		}
		if ($this->_4_6_R->Required) {
			if (!$this->_4_6_R->IsDetailKey && $this->_4_6_R->FormValue != NULL && $this->_4_6_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_4_6_R->caption(), $this->_4_6_R->RequiredErrorMessage));
			}
		}
		if ($this->_4_7_R->Required) {
			if (!$this->_4_7_R->IsDetailKey && $this->_4_7_R->FormValue != NULL && $this->_4_7_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_4_7_R->caption(), $this->_4_7_R->RequiredErrorMessage));
			}
		}
		if ($this->_4_8_R->Required) {
			if (!$this->_4_8_R->IsDetailKey && $this->_4_8_R->FormValue != NULL && $this->_4_8_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_4_8_R->caption(), $this->_4_8_R->RequiredErrorMessage));
			}
		}
		if ($this->_5_9_R->Required) {
			if (!$this->_5_9_R->IsDetailKey && $this->_5_9_R->FormValue != NULL && $this->_5_9_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_5_9_R->caption(), $this->_5_9_R->RequiredErrorMessage));
			}
		}
		if ($this->_5_10_R->Required) {
			if (!$this->_5_10_R->IsDetailKey && $this->_5_10_R->FormValue != NULL && $this->_5_10_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_5_10_R->caption(), $this->_5_10_R->RequiredErrorMessage));
			}
		}
		if ($this->_5_11_R->Required) {
			if (!$this->_5_11_R->IsDetailKey && $this->_5_11_R->FormValue != NULL && $this->_5_11_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_5_11_R->caption(), $this->_5_11_R->RequiredErrorMessage));
			}
		}
		if ($this->_5_12_R->Required) {
			if (!$this->_5_12_R->IsDetailKey && $this->_5_12_R->FormValue != NULL && $this->_5_12_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_5_12_R->caption(), $this->_5_12_R->RequiredErrorMessage));
			}
		}
		if ($this->_5_13_R->Required) {
			if (!$this->_5_13_R->IsDetailKey && $this->_5_13_R->FormValue != NULL && $this->_5_13_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_5_13_R->caption(), $this->_5_13_R->RequiredErrorMessage));
			}
		}
		if ($this->_5_14_R->Required) {
			if (!$this->_5_14_R->IsDetailKey && $this->_5_14_R->FormValue != NULL && $this->_5_14_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_5_14_R->caption(), $this->_5_14_R->RequiredErrorMessage));
			}
		}
		if ($this->_5_51_R->Required) {
			if (!$this->_5_51_R->IsDetailKey && $this->_5_51_R->FormValue != NULL && $this->_5_51_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_5_51_R->caption(), $this->_5_51_R->RequiredErrorMessage));
			}
		}
		if ($this->_6_15_R->Required) {
			if (!$this->_6_15_R->IsDetailKey && $this->_6_15_R->FormValue != NULL && $this->_6_15_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_6_15_R->caption(), $this->_6_15_R->RequiredErrorMessage));
			}
		}
		if ($this->_6_16_R->Required) {
			if (!$this->_6_16_R->IsDetailKey && $this->_6_16_R->FormValue != NULL && $this->_6_16_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_6_16_R->caption(), $this->_6_16_R->RequiredErrorMessage));
			}
		}
		if ($this->_6_17_R->Required) {
			if (!$this->_6_17_R->IsDetailKey && $this->_6_17_R->FormValue != NULL && $this->_6_17_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_6_17_R->caption(), $this->_6_17_R->RequiredErrorMessage));
			}
		}
		if ($this->_6_18_R->Required) {
			if (!$this->_6_18_R->IsDetailKey && $this->_6_18_R->FormValue != NULL && $this->_6_18_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_6_18_R->caption(), $this->_6_18_R->RequiredErrorMessage));
			}
		}
		if ($this->_6_19_R->Required) {
			if (!$this->_6_19_R->IsDetailKey && $this->_6_19_R->FormValue != NULL && $this->_6_19_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_6_19_R->caption(), $this->_6_19_R->RequiredErrorMessage));
			}
		}
		if ($this->_6_20_R->Required) {
			if (!$this->_6_20_R->IsDetailKey && $this->_6_20_R->FormValue != NULL && $this->_6_20_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_6_20_R->caption(), $this->_6_20_R->RequiredErrorMessage));
			}
		}
		if ($this->_6_52_R->Required) {
			if (!$this->_6_52_R->IsDetailKey && $this->_6_52_R->FormValue != NULL && $this->_6_52_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_6_52_R->caption(), $this->_6_52_R->RequiredErrorMessage));
			}
		}
		if ($this->_7_21_R->Required) {
			if (!$this->_7_21_R->IsDetailKey && $this->_7_21_R->FormValue != NULL && $this->_7_21_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_7_21_R->caption(), $this->_7_21_R->RequiredErrorMessage));
			}
		}
		if ($this->_8_22_R->Required) {
			if (!$this->_8_22_R->IsDetailKey && $this->_8_22_R->FormValue != NULL && $this->_8_22_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_8_22_R->caption(), $this->_8_22_R->RequiredErrorMessage));
			}
		}
		if ($this->_8_23_R->Required) {
			if (!$this->_8_23_R->IsDetailKey && $this->_8_23_R->FormValue != NULL && $this->_8_23_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_8_23_R->caption(), $this->_8_23_R->RequiredErrorMessage));
			}
		}
		if ($this->_8_24_R->Required) {
			if (!$this->_8_24_R->IsDetailKey && $this->_8_24_R->FormValue != NULL && $this->_8_24_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_8_24_R->caption(), $this->_8_24_R->RequiredErrorMessage));
			}
		}
		if ($this->_8_25_R->Required) {
			if (!$this->_8_25_R->IsDetailKey && $this->_8_25_R->FormValue != NULL && $this->_8_25_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_8_25_R->caption(), $this->_8_25_R->RequiredErrorMessage));
			}
		}
		if ($this->_9_26_R->Required) {
			if (!$this->_9_26_R->IsDetailKey && $this->_9_26_R->FormValue != NULL && $this->_9_26_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_9_26_R->caption(), $this->_9_26_R->RequiredErrorMessage));
			}
		}
		if ($this->_9_27_R->Required) {
			if (!$this->_9_27_R->IsDetailKey && $this->_9_27_R->FormValue != NULL && $this->_9_27_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_9_27_R->caption(), $this->_9_27_R->RequiredErrorMessage));
			}
		}
		if ($this->_9_28_R->Required) {
			if (!$this->_9_28_R->IsDetailKey && $this->_9_28_R->FormValue != NULL && $this->_9_28_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_9_28_R->caption(), $this->_9_28_R->RequiredErrorMessage));
			}
		}
		if ($this->_9_29_R->Required) {
			if (!$this->_9_29_R->IsDetailKey && $this->_9_29_R->FormValue != NULL && $this->_9_29_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_9_29_R->caption(), $this->_9_29_R->RequiredErrorMessage));
			}
		}
		if ($this->_9_30_R->Required) {
			if (!$this->_9_30_R->IsDetailKey && $this->_9_30_R->FormValue != NULL && $this->_9_30_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_9_30_R->caption(), $this->_9_30_R->RequiredErrorMessage));
			}
		}
		if ($this->_9_31_R->Required) {
			if (!$this->_9_31_R->IsDetailKey && $this->_9_31_R->FormValue != NULL && $this->_9_31_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_9_31_R->caption(), $this->_9_31_R->RequiredErrorMessage));
			}
		}
		if ($this->_9_32_R->Required) {
			if (!$this->_9_32_R->IsDetailKey && $this->_9_32_R->FormValue != NULL && $this->_9_32_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_9_32_R->caption(), $this->_9_32_R->RequiredErrorMessage));
			}
		}
		if ($this->_9_33_R->Required) {
			if (!$this->_9_33_R->IsDetailKey && $this->_9_33_R->FormValue != NULL && $this->_9_33_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_9_33_R->caption(), $this->_9_33_R->RequiredErrorMessage));
			}
		}
		if ($this->_9_34_R->Required) {
			if (!$this->_9_34_R->IsDetailKey && $this->_9_34_R->FormValue != NULL && $this->_9_34_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_9_34_R->caption(), $this->_9_34_R->RequiredErrorMessage));
			}
		}
		if ($this->_9_35_R->Required) {
			if (!$this->_9_35_R->IsDetailKey && $this->_9_35_R->FormValue != NULL && $this->_9_35_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_9_35_R->caption(), $this->_9_35_R->RequiredErrorMessage));
			}
		}
		if ($this->_9_36_R->Required) {
			if (!$this->_9_36_R->IsDetailKey && $this->_9_36_R->FormValue != NULL && $this->_9_36_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_9_36_R->caption(), $this->_9_36_R->RequiredErrorMessage));
			}
		}
		if ($this->_9_37_R->Required) {
			if (!$this->_9_37_R->IsDetailKey && $this->_9_37_R->FormValue != NULL && $this->_9_37_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_9_37_R->caption(), $this->_9_37_R->RequiredErrorMessage));
			}
		}
		if ($this->_9_38_R->Required) {
			if (!$this->_9_38_R->IsDetailKey && $this->_9_38_R->FormValue != NULL && $this->_9_38_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_9_38_R->caption(), $this->_9_38_R->RequiredErrorMessage));
			}
		}
		if ($this->_9_39_R->Required) {
			if (!$this->_9_39_R->IsDetailKey && $this->_9_39_R->FormValue != NULL && $this->_9_39_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_9_39_R->caption(), $this->_9_39_R->RequiredErrorMessage));
			}
		}
		if ($this->_10_40_R->Required) {
			if (!$this->_10_40_R->IsDetailKey && $this->_10_40_R->FormValue != NULL && $this->_10_40_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_10_40_R->caption(), $this->_10_40_R->RequiredErrorMessage));
			}
		}
		if ($this->_10_41_R->Required) {
			if (!$this->_10_41_R->IsDetailKey && $this->_10_41_R->FormValue != NULL && $this->_10_41_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_10_41_R->caption(), $this->_10_41_R->RequiredErrorMessage));
			}
		}
		if ($this->_11_42_R->Required) {
			if (!$this->_11_42_R->IsDetailKey && $this->_11_42_R->FormValue != NULL && $this->_11_42_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_11_42_R->caption(), $this->_11_42_R->RequiredErrorMessage));
			}
		}
		if ($this->_11_43_R->Required) {
			if (!$this->_11_43_R->IsDetailKey && $this->_11_43_R->FormValue != NULL && $this->_11_43_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_11_43_R->caption(), $this->_11_43_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_44_R->Required) {
			if (!$this->_12_44_R->IsDetailKey && $this->_12_44_R->FormValue != NULL && $this->_12_44_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_44_R->caption(), $this->_12_44_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_45_R->Required) {
			if (!$this->_12_45_R->IsDetailKey && $this->_12_45_R->FormValue != NULL && $this->_12_45_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_45_R->caption(), $this->_12_45_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_46_R->Required) {
			if (!$this->_12_46_R->IsDetailKey && $this->_12_46_R->FormValue != NULL && $this->_12_46_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_46_R->caption(), $this->_12_46_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_47_R->Required) {
			if (!$this->_12_47_R->IsDetailKey && $this->_12_47_R->FormValue != NULL && $this->_12_47_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_47_R->caption(), $this->_12_47_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_48_R->Required) {
			if (!$this->_12_48_R->IsDetailKey && $this->_12_48_R->FormValue != NULL && $this->_12_48_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_48_R->caption(), $this->_12_48_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_49_R->Required) {
			if (!$this->_12_49_R->IsDetailKey && $this->_12_49_R->FormValue != NULL && $this->_12_49_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_49_R->caption(), $this->_12_49_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_50_R->Required) {
			if (!$this->_12_50_R->IsDetailKey && $this->_12_50_R->FormValue != NULL && $this->_12_50_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_50_R->caption(), $this->_12_50_R->RequiredErrorMessage));
			}
		}
		if ($this->_1__R->Required) {
			if (!$this->_1__R->IsDetailKey && $this->_1__R->FormValue != NULL && $this->_1__R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_1__R->caption(), $this->_1__R->RequiredErrorMessage));
			}
		}
		if ($this->_13_54_R->Required) {
			if (!$this->_13_54_R->IsDetailKey && $this->_13_54_R->FormValue != NULL && $this->_13_54_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_54_R->caption(), $this->_13_54_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_54_1_R->Required) {
			if (!$this->_13_54_1_R->IsDetailKey && $this->_13_54_1_R->FormValue != NULL && $this->_13_54_1_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_54_1_R->caption(), $this->_13_54_1_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_54_2_R->Required) {
			if (!$this->_13_54_2_R->IsDetailKey && $this->_13_54_2_R->FormValue != NULL && $this->_13_54_2_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_54_2_R->caption(), $this->_13_54_2_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_55_R->Required) {
			if (!$this->_13_55_R->IsDetailKey && $this->_13_55_R->FormValue != NULL && $this->_13_55_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_55_R->caption(), $this->_13_55_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_55_1_R->Required) {
			if (!$this->_13_55_1_R->IsDetailKey && $this->_13_55_1_R->FormValue != NULL && $this->_13_55_1_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_55_1_R->caption(), $this->_13_55_1_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_55_2_R->Required) {
			if (!$this->_13_55_2_R->IsDetailKey && $this->_13_55_2_R->FormValue != NULL && $this->_13_55_2_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_55_2_R->caption(), $this->_13_55_2_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_56_R->Required) {
			if (!$this->_13_56_R->IsDetailKey && $this->_13_56_R->FormValue != NULL && $this->_13_56_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_56_R->caption(), $this->_13_56_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_56_1_R->Required) {
			if (!$this->_13_56_1_R->IsDetailKey && $this->_13_56_1_R->FormValue != NULL && $this->_13_56_1_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_56_1_R->caption(), $this->_13_56_1_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_56_2_R->Required) {
			if (!$this->_13_56_2_R->IsDetailKey && $this->_13_56_2_R->FormValue != NULL && $this->_13_56_2_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_56_2_R->caption(), $this->_13_56_2_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_53_R->Required) {
			if (!$this->_12_53_R->IsDetailKey && $this->_12_53_R->FormValue != NULL && $this->_12_53_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_53_R->caption(), $this->_12_53_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_53_1_R->Required) {
			if (!$this->_12_53_1_R->IsDetailKey && $this->_12_53_1_R->FormValue != NULL && $this->_12_53_1_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_53_1_R->caption(), $this->_12_53_1_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_53_2_R->Required) {
			if (!$this->_12_53_2_R->IsDetailKey && $this->_12_53_2_R->FormValue != NULL && $this->_12_53_2_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_53_2_R->caption(), $this->_12_53_2_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_53_3_R->Required) {
			if (!$this->_12_53_3_R->IsDetailKey && $this->_12_53_3_R->FormValue != NULL && $this->_12_53_3_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_53_3_R->caption(), $this->_12_53_3_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_53_4_R->Required) {
			if (!$this->_12_53_4_R->IsDetailKey && $this->_12_53_4_R->FormValue != NULL && $this->_12_53_4_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_53_4_R->caption(), $this->_12_53_4_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_53_5_R->Required) {
			if (!$this->_12_53_5_R->IsDetailKey && $this->_12_53_5_R->FormValue != NULL && $this->_12_53_5_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_53_5_R->caption(), $this->_12_53_5_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_53_6_R->Required) {
			if (!$this->_12_53_6_R->IsDetailKey && $this->_12_53_6_R->FormValue != NULL && $this->_12_53_6_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_53_6_R->caption(), $this->_12_53_6_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_57_R->Required) {
			if (!$this->_13_57_R->IsDetailKey && $this->_13_57_R->FormValue != NULL && $this->_13_57_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_57_R->caption(), $this->_13_57_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_57_1_R->Required) {
			if (!$this->_13_57_1_R->IsDetailKey && $this->_13_57_1_R->FormValue != NULL && $this->_13_57_1_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_57_1_R->caption(), $this->_13_57_1_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_57_2_R->Required) {
			if (!$this->_13_57_2_R->IsDetailKey && $this->_13_57_2_R->FormValue != NULL && $this->_13_57_2_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_57_2_R->caption(), $this->_13_57_2_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_58_R->Required) {
			if (!$this->_13_58_R->IsDetailKey && $this->_13_58_R->FormValue != NULL && $this->_13_58_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_58_R->caption(), $this->_13_58_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_58_1_R->Required) {
			if (!$this->_13_58_1_R->IsDetailKey && $this->_13_58_1_R->FormValue != NULL && $this->_13_58_1_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_58_1_R->caption(), $this->_13_58_1_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_58_2_R->Required) {
			if (!$this->_13_58_2_R->IsDetailKey && $this->_13_58_2_R->FormValue != NULL && $this->_13_58_2_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_58_2_R->caption(), $this->_13_58_2_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_59_R->Required) {
			if (!$this->_13_59_R->IsDetailKey && $this->_13_59_R->FormValue != NULL && $this->_13_59_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_59_R->caption(), $this->_13_59_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_59_1_R->Required) {
			if (!$this->_13_59_1_R->IsDetailKey && $this->_13_59_1_R->FormValue != NULL && $this->_13_59_1_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_59_1_R->caption(), $this->_13_59_1_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_59_2_R->Required) {
			if (!$this->_13_59_2_R->IsDetailKey && $this->_13_59_2_R->FormValue != NULL && $this->_13_59_2_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_59_2_R->caption(), $this->_13_59_2_R->RequiredErrorMessage));
			}
		}
		if ($this->_13_60_R->Required) {
			if (!$this->_13_60_R->IsDetailKey && $this->_13_60_R->FormValue != NULL && $this->_13_60_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_13_60_R->caption(), $this->_13_60_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_53_7_R->Required) {
			if (!$this->_12_53_7_R->IsDetailKey && $this->_12_53_7_R->FormValue != NULL && $this->_12_53_7_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_53_7_R->caption(), $this->_12_53_7_R->RequiredErrorMessage));
			}
		}
		if ($this->_12_53_8_R->Required) {
			if (!$this->_12_53_8_R->IsDetailKey && $this->_12_53_8_R->FormValue != NULL && $this->_12_53_8_R->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_12_53_8_R->caption(), $this->_12_53_8_R->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// fecha
			$this->fecha->setDbValueDef($rsnew, UnFormatDateTime($this->fecha->CurrentValue, 0), NULL, $this->fecha->ReadOnly);

			// hora
			$this->hora->setDbValueDef($rsnew, $this->hora->CurrentValue, CurrentTime(), $this->hora->ReadOnly);

			// audio
			$this->audio->setDbValueDef($rsnew, $this->audio->CurrentValue, NULL, $this->audio->ReadOnly);

			// st
			$this->st->setDbValueDef($rsnew, $this->st->CurrentValue, NULL, $this->st->ReadOnly);

			// fechaHoraIni
			$this->fechaHoraIni->setDbValueDef($rsnew, UnFormatDateTime($this->fechaHoraIni->CurrentValue, 0), CurrentDate(), $this->fechaHoraIni->ReadOnly);

			// fechaHoraFin
			$this->fechaHoraFin->setDbValueDef($rsnew, UnFormatDateTime($this->fechaHoraFin->CurrentValue, 0), CurrentDate(), $this->fechaHoraFin->ReadOnly);

			// telefono
			$this->telefono->setDbValueDef($rsnew, $this->telefono->CurrentValue, "", $this->telefono->ReadOnly);

			// agente
			$this->agente->setDbValueDef($rsnew, $this->agente->CurrentValue, 0, $this->agente->ReadOnly);

			// fechabo
			$this->fechabo->setDbValueDef($rsnew, UnFormatDateTime($this->fechabo->CurrentValue, 0), NULL, $this->fechabo->ReadOnly);

			// agentebo
			$this->agentebo->setDbValueDef($rsnew, $this->agentebo->CurrentValue, NULL, $this->agentebo->ReadOnly);

			// comentariosbo
			$this->comentariosbo->setDbValueDef($rsnew, $this->comentariosbo->CurrentValue, NULL, $this->comentariosbo->ReadOnly);

			// IP
			$this->IP->setDbValueDef($rsnew, $this->IP->CurrentValue, NULL, $this->IP->ReadOnly);

			// actual
			$this->actual->setDbValueDef($rsnew, $this->actual->CurrentValue, NULL, $this->actual->ReadOnly);

			// completado
			$this->completado->setDbValueDef($rsnew, $this->completado->CurrentValue, NULL, $this->completado->ReadOnly);

			// 2_1_R
			$this->_2_1_R->setDbValueDef($rsnew, $this->_2_1_R->CurrentValue, NULL, $this->_2_1_R->ReadOnly);

			// 2_2_R
			$this->_2_2_R->setDbValueDef($rsnew, $this->_2_2_R->CurrentValue, NULL, $this->_2_2_R->ReadOnly);

			// 2_3_R
			$this->_2_3_R->setDbValueDef($rsnew, $this->_2_3_R->CurrentValue, NULL, $this->_2_3_R->ReadOnly);

			// 3_4_R
			$this->_3_4_R->setDbValueDef($rsnew, $this->_3_4_R->CurrentValue, NULL, $this->_3_4_R->ReadOnly);

			// 4_5_R
			$this->_4_5_R->setDbValueDef($rsnew, $this->_4_5_R->CurrentValue, NULL, $this->_4_5_R->ReadOnly);

			// 4_6_R
			$this->_4_6_R->setDbValueDef($rsnew, $this->_4_6_R->CurrentValue, NULL, $this->_4_6_R->ReadOnly);

			// 4_7_R
			$this->_4_7_R->setDbValueDef($rsnew, $this->_4_7_R->CurrentValue, NULL, $this->_4_7_R->ReadOnly);

			// 4_8_R
			$this->_4_8_R->setDbValueDef($rsnew, $this->_4_8_R->CurrentValue, NULL, $this->_4_8_R->ReadOnly);

			// 5_9_R
			$this->_5_9_R->setDbValueDef($rsnew, $this->_5_9_R->CurrentValue, NULL, $this->_5_9_R->ReadOnly);

			// 5_10_R
			$this->_5_10_R->setDbValueDef($rsnew, $this->_5_10_R->CurrentValue, NULL, $this->_5_10_R->ReadOnly);

			// 5_11_R
			$this->_5_11_R->setDbValueDef($rsnew, $this->_5_11_R->CurrentValue, NULL, $this->_5_11_R->ReadOnly);

			// 5_12_R
			$this->_5_12_R->setDbValueDef($rsnew, $this->_5_12_R->CurrentValue, NULL, $this->_5_12_R->ReadOnly);

			// 5_13_R
			$this->_5_13_R->setDbValueDef($rsnew, $this->_5_13_R->CurrentValue, NULL, $this->_5_13_R->ReadOnly);

			// 5_14_R
			$this->_5_14_R->setDbValueDef($rsnew, $this->_5_14_R->CurrentValue, NULL, $this->_5_14_R->ReadOnly);

			// 5_51_R
			$this->_5_51_R->setDbValueDef($rsnew, $this->_5_51_R->CurrentValue, NULL, $this->_5_51_R->ReadOnly);

			// 6_15_R
			$this->_6_15_R->setDbValueDef($rsnew, $this->_6_15_R->CurrentValue, NULL, $this->_6_15_R->ReadOnly);

			// 6_16_R
			$this->_6_16_R->setDbValueDef($rsnew, $this->_6_16_R->CurrentValue, NULL, $this->_6_16_R->ReadOnly);

			// 6_17_R
			$this->_6_17_R->setDbValueDef($rsnew, $this->_6_17_R->CurrentValue, NULL, $this->_6_17_R->ReadOnly);

			// 6_18_R
			$this->_6_18_R->setDbValueDef($rsnew, $this->_6_18_R->CurrentValue, NULL, $this->_6_18_R->ReadOnly);

			// 6_19_R
			$this->_6_19_R->setDbValueDef($rsnew, $this->_6_19_R->CurrentValue, NULL, $this->_6_19_R->ReadOnly);

			// 6_20_R
			$this->_6_20_R->setDbValueDef($rsnew, $this->_6_20_R->CurrentValue, NULL, $this->_6_20_R->ReadOnly);

			// 6_52_R
			$this->_6_52_R->setDbValueDef($rsnew, $this->_6_52_R->CurrentValue, NULL, $this->_6_52_R->ReadOnly);

			// 7_21_R
			$this->_7_21_R->setDbValueDef($rsnew, $this->_7_21_R->CurrentValue, NULL, $this->_7_21_R->ReadOnly);

			// 8_22_R
			$this->_8_22_R->setDbValueDef($rsnew, $this->_8_22_R->CurrentValue, NULL, $this->_8_22_R->ReadOnly);

			// 8_23_R
			$this->_8_23_R->setDbValueDef($rsnew, $this->_8_23_R->CurrentValue, NULL, $this->_8_23_R->ReadOnly);

			// 8_24_R
			$this->_8_24_R->setDbValueDef($rsnew, $this->_8_24_R->CurrentValue, NULL, $this->_8_24_R->ReadOnly);

			// 8_25_R
			$this->_8_25_R->setDbValueDef($rsnew, $this->_8_25_R->CurrentValue, NULL, $this->_8_25_R->ReadOnly);

			// 9_26_R
			$this->_9_26_R->setDbValueDef($rsnew, $this->_9_26_R->CurrentValue, NULL, $this->_9_26_R->ReadOnly);

			// 9_27_R
			$this->_9_27_R->setDbValueDef($rsnew, $this->_9_27_R->CurrentValue, NULL, $this->_9_27_R->ReadOnly);

			// 9_28_R
			$this->_9_28_R->setDbValueDef($rsnew, $this->_9_28_R->CurrentValue, NULL, $this->_9_28_R->ReadOnly);

			// 9_29_R
			$this->_9_29_R->setDbValueDef($rsnew, $this->_9_29_R->CurrentValue, NULL, $this->_9_29_R->ReadOnly);

			// 9_30_R
			$this->_9_30_R->setDbValueDef($rsnew, $this->_9_30_R->CurrentValue, NULL, $this->_9_30_R->ReadOnly);

			// 9_31_R
			$this->_9_31_R->setDbValueDef($rsnew, $this->_9_31_R->CurrentValue, NULL, $this->_9_31_R->ReadOnly);

			// 9_32_R
			$this->_9_32_R->setDbValueDef($rsnew, $this->_9_32_R->CurrentValue, NULL, $this->_9_32_R->ReadOnly);

			// 9_33_R
			$this->_9_33_R->setDbValueDef($rsnew, $this->_9_33_R->CurrentValue, NULL, $this->_9_33_R->ReadOnly);

			// 9_34_R
			$this->_9_34_R->setDbValueDef($rsnew, $this->_9_34_R->CurrentValue, NULL, $this->_9_34_R->ReadOnly);

			// 9_35_R
			$this->_9_35_R->setDbValueDef($rsnew, $this->_9_35_R->CurrentValue, NULL, $this->_9_35_R->ReadOnly);

			// 9_36_R
			$this->_9_36_R->setDbValueDef($rsnew, $this->_9_36_R->CurrentValue, NULL, $this->_9_36_R->ReadOnly);

			// 9_37_R
			$this->_9_37_R->setDbValueDef($rsnew, $this->_9_37_R->CurrentValue, NULL, $this->_9_37_R->ReadOnly);

			// 9_38_R
			$this->_9_38_R->setDbValueDef($rsnew, $this->_9_38_R->CurrentValue, NULL, $this->_9_38_R->ReadOnly);

			// 9_39_R
			$this->_9_39_R->setDbValueDef($rsnew, $this->_9_39_R->CurrentValue, NULL, $this->_9_39_R->ReadOnly);

			// 10_40_R
			$this->_10_40_R->setDbValueDef($rsnew, $this->_10_40_R->CurrentValue, NULL, $this->_10_40_R->ReadOnly);

			// 10_41_R
			$this->_10_41_R->setDbValueDef($rsnew, $this->_10_41_R->CurrentValue, NULL, $this->_10_41_R->ReadOnly);

			// 11_42_R
			$this->_11_42_R->setDbValueDef($rsnew, $this->_11_42_R->CurrentValue, NULL, $this->_11_42_R->ReadOnly);

			// 11_43_R
			$this->_11_43_R->setDbValueDef($rsnew, $this->_11_43_R->CurrentValue, NULL, $this->_11_43_R->ReadOnly);

			// 12_44_R
			$this->_12_44_R->setDbValueDef($rsnew, $this->_12_44_R->CurrentValue, NULL, $this->_12_44_R->ReadOnly);

			// 12_45_R
			$this->_12_45_R->setDbValueDef($rsnew, $this->_12_45_R->CurrentValue, NULL, $this->_12_45_R->ReadOnly);

			// 12_46_R
			$this->_12_46_R->setDbValueDef($rsnew, $this->_12_46_R->CurrentValue, NULL, $this->_12_46_R->ReadOnly);

			// 12_47_R
			$this->_12_47_R->setDbValueDef($rsnew, $this->_12_47_R->CurrentValue, NULL, $this->_12_47_R->ReadOnly);

			// 12_48_R
			$this->_12_48_R->setDbValueDef($rsnew, $this->_12_48_R->CurrentValue, NULL, $this->_12_48_R->ReadOnly);

			// 12_49_R
			$this->_12_49_R->setDbValueDef($rsnew, $this->_12_49_R->CurrentValue, NULL, $this->_12_49_R->ReadOnly);

			// 12_50_R
			$this->_12_50_R->setDbValueDef($rsnew, $this->_12_50_R->CurrentValue, NULL, $this->_12_50_R->ReadOnly);

			// 1__R
			$this->_1__R->setDbValueDef($rsnew, $this->_1__R->CurrentValue, NULL, $this->_1__R->ReadOnly);

			// 13_54_R
			$this->_13_54_R->setDbValueDef($rsnew, $this->_13_54_R->CurrentValue, NULL, $this->_13_54_R->ReadOnly);

			// 13_54_1_R
			$this->_13_54_1_R->setDbValueDef($rsnew, $this->_13_54_1_R->CurrentValue, NULL, $this->_13_54_1_R->ReadOnly);

			// 13_54_2_R
			$this->_13_54_2_R->setDbValueDef($rsnew, $this->_13_54_2_R->CurrentValue, NULL, $this->_13_54_2_R->ReadOnly);

			// 13_55_R
			$this->_13_55_R->setDbValueDef($rsnew, $this->_13_55_R->CurrentValue, NULL, $this->_13_55_R->ReadOnly);

			// 13_55_1_R
			$this->_13_55_1_R->setDbValueDef($rsnew, $this->_13_55_1_R->CurrentValue, NULL, $this->_13_55_1_R->ReadOnly);

			// 13_55_2_R
			$this->_13_55_2_R->setDbValueDef($rsnew, $this->_13_55_2_R->CurrentValue, NULL, $this->_13_55_2_R->ReadOnly);

			// 13_56_R
			$this->_13_56_R->setDbValueDef($rsnew, $this->_13_56_R->CurrentValue, NULL, $this->_13_56_R->ReadOnly);

			// 13_56_1_R
			$this->_13_56_1_R->setDbValueDef($rsnew, $this->_13_56_1_R->CurrentValue, NULL, $this->_13_56_1_R->ReadOnly);

			// 13_56_2_R
			$this->_13_56_2_R->setDbValueDef($rsnew, $this->_13_56_2_R->CurrentValue, NULL, $this->_13_56_2_R->ReadOnly);

			// 12_53_R
			$this->_12_53_R->setDbValueDef($rsnew, $this->_12_53_R->CurrentValue, NULL, $this->_12_53_R->ReadOnly);

			// 12_53_1_R
			$this->_12_53_1_R->setDbValueDef($rsnew, $this->_12_53_1_R->CurrentValue, NULL, $this->_12_53_1_R->ReadOnly);

			// 12_53_2_R
			$this->_12_53_2_R->setDbValueDef($rsnew, $this->_12_53_2_R->CurrentValue, NULL, $this->_12_53_2_R->ReadOnly);

			// 12_53_3_R
			$this->_12_53_3_R->setDbValueDef($rsnew, $this->_12_53_3_R->CurrentValue, NULL, $this->_12_53_3_R->ReadOnly);

			// 12_53_4_R
			$this->_12_53_4_R->setDbValueDef($rsnew, $this->_12_53_4_R->CurrentValue, NULL, $this->_12_53_4_R->ReadOnly);

			// 12_53_5_R
			$this->_12_53_5_R->setDbValueDef($rsnew, $this->_12_53_5_R->CurrentValue, NULL, $this->_12_53_5_R->ReadOnly);

			// 12_53_6_R
			$this->_12_53_6_R->setDbValueDef($rsnew, $this->_12_53_6_R->CurrentValue, NULL, $this->_12_53_6_R->ReadOnly);

			// 13_57_R
			$this->_13_57_R->setDbValueDef($rsnew, $this->_13_57_R->CurrentValue, NULL, $this->_13_57_R->ReadOnly);

			// 13_57_1_R
			$this->_13_57_1_R->setDbValueDef($rsnew, $this->_13_57_1_R->CurrentValue, NULL, $this->_13_57_1_R->ReadOnly);

			// 13_57_2_R
			$this->_13_57_2_R->setDbValueDef($rsnew, $this->_13_57_2_R->CurrentValue, NULL, $this->_13_57_2_R->ReadOnly);

			// 13_58_R
			$this->_13_58_R->setDbValueDef($rsnew, $this->_13_58_R->CurrentValue, NULL, $this->_13_58_R->ReadOnly);

			// 13_58_1_R
			$this->_13_58_1_R->setDbValueDef($rsnew, $this->_13_58_1_R->CurrentValue, NULL, $this->_13_58_1_R->ReadOnly);

			// 13_58_2_R
			$this->_13_58_2_R->setDbValueDef($rsnew, $this->_13_58_2_R->CurrentValue, NULL, $this->_13_58_2_R->ReadOnly);

			// 13_59_R
			$this->_13_59_R->setDbValueDef($rsnew, $this->_13_59_R->CurrentValue, NULL, $this->_13_59_R->ReadOnly);

			// 13_59_1_R
			$this->_13_59_1_R->setDbValueDef($rsnew, $this->_13_59_1_R->CurrentValue, NULL, $this->_13_59_1_R->ReadOnly);

			// 13_59_2_R
			$this->_13_59_2_R->setDbValueDef($rsnew, $this->_13_59_2_R->CurrentValue, NULL, $this->_13_59_2_R->ReadOnly);

			// 13_60_R
			$this->_13_60_R->setDbValueDef($rsnew, $this->_13_60_R->CurrentValue, NULL, $this->_13_60_R->ReadOnly);

			// 12_53_7_R
			$this->_12_53_7_R->setDbValueDef($rsnew, $this->_12_53_7_R->CurrentValue, NULL, $this->_12_53_7_R->ReadOnly);

			// 12_53_8_R
			$this->_12_53_8_R->setDbValueDef($rsnew, $this->_12_53_8_R->CurrentValue, NULL, $this->_12_53_8_R->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew); 
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("bdvlist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$conn = $this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			} elseif ($pageNo !== NULL) {
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>