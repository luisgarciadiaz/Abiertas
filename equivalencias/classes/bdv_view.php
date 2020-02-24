<?php
namespace PHPMaker2020\project1;

/**
 * Page class
 */
class bdv_view extends bdv
{

	// Page ID
	public $PageID = "view";

	// Project ID
	public $ProjectID = "{BCBBB89F-782F-4C8E-A4DB-F05CA52E74C8}";

	// Table name
	public $TableName = 'bdv';

	// Page object name
	public $PageObjName = "bdv_view";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Export URLs
	public $ExportPrintUrl;
	public $ExportHtmlUrl;
	public $ExportExcelUrl;
	public $ExportWordUrl;
	public $ExportXmlUrl;
	public $ExportCsvUrl;
	public $ExportPdfUrl;

	// Custom export
	public $ExportExcelCustom = FALSE;
	public $ExportWordCustom = FALSE;
	public $ExportPdfCustom = FALSE;
	public $ExportEmailCustom = FALSE;

	// Update URLs
	public $InlineAddUrl;
	public $InlineCopyUrl;
	public $InlineEditUrl;
	public $GridAddUrl;
	public $GridEditUrl;
	public $MultiDeleteUrl;
	public $MultiUpdateUrl;

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
		$keyUrl = "";
		if (Get("id") !== NULL) {
			$this->RecKey["id"] = Get("id");
			$keyUrl .= "&amp;id=" . urlencode($this->RecKey["id"]);
		}
		$this->ExportPrintUrl = $this->pageUrl() . "export=print" . $keyUrl;
		$this->ExportHtmlUrl = $this->pageUrl() . "export=html" . $keyUrl;
		$this->ExportExcelUrl = $this->pageUrl() . "export=excel" . $keyUrl;
		$this->ExportWordUrl = $this->pageUrl() . "export=word" . $keyUrl;
		$this->ExportXmlUrl = $this->pageUrl() . "export=xml" . $keyUrl;
		$this->ExportCsvUrl = $this->pageUrl() . "export=csv" . $keyUrl;
		$this->ExportPdfUrl = $this->pageUrl() . "export=pdf" . $keyUrl;

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'view');

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

		// Export options
		$this->ExportOptions = new ListOptions("div");
		$this->ExportOptions->TagClassName = "ew-export-option";

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["action"] = new ListOptions("div");
		$this->OtherOptions["action"]->TagClassName = "ew-action-option";
		$this->OtherOptions["detail"] = new ListOptions("div");
		$this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
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
	public $ExportOptions; // Export options
	public $OtherOptions; // Other options
	public $DisplayRecords = 1;
	public $DbMasterFilter;
	public $DbDetailFilter;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $RecKey = [];
	public $IsModal = FALSE;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (!$this->setupApiRequest()) {
			$Security = new AdvancedSecurity();
		}
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

		// Load current record
		$loadCurrentRecord = FALSE;
		$returnUrl = "";
		$matchRecord = FALSE;
		if ($this->isPageRequest()) { // Validate request
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->RecKey["id"] = $this->id->QueryStringValue;
			} elseif (IsApi() && Key(0) != NULL) {
				$this->id->setQueryStringValue(Key(0));
				$this->RecKey["id"] = $this->id->QueryStringValue;
			} elseif (Post("id") !== NULL) {
				$this->id->setFormValue(Post("id"));
				$this->RecKey["id"] = $this->id->FormValue;
			} elseif (IsApi() && Route(2) != NULL) {
				$this->id->setFormValue(Route(2));
				$this->RecKey["id"] = $this->id->FormValue;
			} else {
				$returnUrl = "bdvlist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "show"; // Display
			switch ($this->CurrentAction) {
				case "show": // Get a record to display

					// Load record based on key
					if (IsApi()) {
						$filter = $this->getRecordFilter();
						$this->CurrentFilter = $filter;
						$sql = $this->getCurrentSql();
						$conn = $this->getConnection();
						$this->Recordset = LoadRecordset($sql, $conn);
						$res = $this->Recordset && !$this->Recordset->EOF;
					} else {
						$res = $this->loadRow();
					}
					if (!$res) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
						$returnUrl = "bdvlist.php"; // No matching record, return to list
					}
			}
		} else {
			$returnUrl = "bdvlist.php"; // Not page request, return to list
		}
		if ($returnUrl != "") {
			$this->terminate($returnUrl);
			return;
		}

		// Set up Breadcrumb
		if (!$this->isExport())
			$this->setupBreadcrumb();

		// Render row
		$this->RowType = ROWTYPE_VIEW;
		$this->resetAttributes();
		$this->renderRow();

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset, TRUE); // Get current record only
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows]);
			$this->terminate(TRUE);
		}
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Add
		$item = &$option->add("add");
		$addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->AddUrl) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl != "");

		// Edit
		$item = &$option->add("edit");
		$editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode($this->EditUrl) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl != "");

		// Copy
		$item = &$option->add("copy");
		$copycaption = HtmlTitle($Language->phrase("ViewPageCopyLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode($this->CopyUrl) . "'});\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
		$item->Visible = ($this->CopyUrl != "");

		// Delete
		$item = &$option->add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew.confirmDelete(this);\" class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(UrlAddQuery($this->DeleteUrl, "action=1")) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl != "");

		// Set up action default
		$option = $options["action"];
		$option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
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

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->AddUrl = $this->getAddUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();
		$this->ListUrl = $this->getListUrl();
		$this->setupOtherOptions();

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
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("bdvlist.php"), "", $this->TableVar, TRUE);
		$pageId = "view";
		$Breadcrumb->add("view", $pageId, $url);
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

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
} // End class
?>