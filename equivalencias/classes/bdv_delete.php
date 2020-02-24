<?php
namespace PHPMaker2020\project1;

/**
 * Page class
 */
class bdv_delete extends bdv
{

	// Page ID
	public $PageID = "delete";

	// Project ID
	public $ProjectID = "{BCBBB89F-782F-4C8E-A4DB-F05CA52E74C8}";

	// Table name
	public $TableName = 'bdv';

	// Page object name
	public $PageObjName = "bdv_delete";

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
			define(PROJECT_NAMESPACE . "PAGE_ID", 'delete');

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
			SaveDebugMessage();
			AddHeader("Location", $url);
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
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $TotalRecords = 0;
	public $RecordCount;
	public $RecKeys = [];
	public $StartRowCount = 1;
	public $RowCount = 0;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

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
		$this->comentariosbo->Visible = FALSE;
		$this->IP->setVisibility();
		$this->actual->setVisibility();
		$this->completado->setVisibility();
		$this->_2_1_R->Visible = FALSE;
		$this->_2_2_R->Visible = FALSE;
		$this->_2_3_R->Visible = FALSE;
		$this->_3_4_R->Visible = FALSE;
		$this->_4_5_R->Visible = FALSE;
		$this->_4_6_R->Visible = FALSE;
		$this->_4_7_R->Visible = FALSE;
		$this->_4_8_R->Visible = FALSE;
		$this->_5_9_R->Visible = FALSE;
		$this->_5_10_R->Visible = FALSE;
		$this->_5_11_R->Visible = FALSE;
		$this->_5_12_R->Visible = FALSE;
		$this->_5_13_R->Visible = FALSE;
		$this->_5_14_R->Visible = FALSE;
		$this->_5_51_R->Visible = FALSE;
		$this->_6_15_R->Visible = FALSE;
		$this->_6_16_R->Visible = FALSE;
		$this->_6_17_R->Visible = FALSE;
		$this->_6_18_R->Visible = FALSE;
		$this->_6_19_R->Visible = FALSE;
		$this->_6_20_R->Visible = FALSE;
		$this->_6_52_R->Visible = FALSE;
		$this->_7_21_R->Visible = FALSE;
		$this->_8_22_R->Visible = FALSE;
		$this->_8_23_R->Visible = FALSE;
		$this->_8_24_R->Visible = FALSE;
		$this->_8_25_R->Visible = FALSE;
		$this->_9_26_R->Visible = FALSE;
		$this->_9_27_R->Visible = FALSE;
		$this->_9_28_R->Visible = FALSE;
		$this->_9_29_R->Visible = FALSE;
		$this->_9_30_R->Visible = FALSE;
		$this->_9_31_R->Visible = FALSE;
		$this->_9_32_R->Visible = FALSE;
		$this->_9_33_R->Visible = FALSE;
		$this->_9_34_R->Visible = FALSE;
		$this->_9_35_R->Visible = FALSE;
		$this->_9_36_R->Visible = FALSE;
		$this->_9_37_R->Visible = FALSE;
		$this->_9_38_R->Visible = FALSE;
		$this->_9_39_R->Visible = FALSE;
		$this->_10_40_R->Visible = FALSE;
		$this->_10_41_R->Visible = FALSE;
		$this->_11_42_R->Visible = FALSE;
		$this->_11_43_R->Visible = FALSE;
		$this->_12_44_R->Visible = FALSE;
		$this->_12_45_R->Visible = FALSE;
		$this->_12_46_R->Visible = FALSE;
		$this->_12_47_R->Visible = FALSE;
		$this->_12_48_R->Visible = FALSE;
		$this->_12_49_R->Visible = FALSE;
		$this->_12_50_R->Visible = FALSE;
		$this->_1__R->Visible = FALSE;
		$this->_13_54_R->Visible = FALSE;
		$this->_13_54_1_R->Visible = FALSE;
		$this->_13_54_2_R->Visible = FALSE;
		$this->_13_55_R->Visible = FALSE;
		$this->_13_55_1_R->Visible = FALSE;
		$this->_13_55_2_R->Visible = FALSE;
		$this->_13_56_R->Visible = FALSE;
		$this->_13_56_1_R->Visible = FALSE;
		$this->_13_56_2_R->Visible = FALSE;
		$this->_12_53_R->Visible = FALSE;
		$this->_12_53_1_R->Visible = FALSE;
		$this->_12_53_2_R->Visible = FALSE;
		$this->_12_53_3_R->Visible = FALSE;
		$this->_12_53_4_R->Visible = FALSE;
		$this->_12_53_5_R->Visible = FALSE;
		$this->_12_53_6_R->Visible = FALSE;
		$this->_13_57_R->Visible = FALSE;
		$this->_13_57_1_R->Visible = FALSE;
		$this->_13_57_2_R->Visible = FALSE;
		$this->_13_58_R->Visible = FALSE;
		$this->_13_58_1_R->Visible = FALSE;
		$this->_13_58_2_R->Visible = FALSE;
		$this->_13_59_R->Visible = FALSE;
		$this->_13_59_1_R->Visible = FALSE;
		$this->_13_59_2_R->Visible = FALSE;
		$this->_13_60_R->Visible = FALSE;
		$this->_12_53_7_R->Visible = FALSE;
		$this->_12_53_8_R->Visible = FALSE;
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
		// Set up Breadcrumb

		$this->setupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->getRecordKeys(); // Load record keys
		$filter = $this->getFilterFromRecordKeys();
		if ($filter == "") {
			$this->terminate("bdvlist.php"); // Prevent SQL injection, return to list
			return;
		}

		// Set up filter (WHERE Clause)
		$this->CurrentFilter = $filter;

		// Get action
		if (IsApi()) {
			$this->CurrentAction = "delete"; // Delete record directly
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action");
		} elseif (Get("action") == "1") {
			$this->CurrentAction = "delete"; // Delete record directly
		} else {
			$this->CurrentAction = "show"; // Display record
		}
		if ($this->isDelete()) {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->deleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
				if (IsApi()) {
					$this->terminate(TRUE);
					return;
				} else {
					$this->terminate($this->getReturnUrl()); // Return to caller
				}
			} else { // Delete failed
				if (IsApi()) {
					$this->terminate();
					return;
				}
				$this->CurrentAction = "show"; // Display record
			}
		}
		if ($this->isShow()) { // Load records for display
			if ($this->Recordset = $this->loadRecordset())
				$this->TotalRecords = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecords <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->close();
				$this->terminate("bdvlist.php"); // Return to list
			}
		}
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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

			// IP
			$this->IP->ViewValue = $this->IP->CurrentValue;
			$this->IP->ViewCustomAttributes = "";

			// actual
			$this->actual->ViewValue = $this->actual->CurrentValue;
			$this->actual->ViewCustomAttributes = "";

			// completado
			$this->completado->ViewValue = $this->completado->CurrentValue;
			$this->completado->ViewCustomAttributes = "";

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
		}

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];
		$conn->beginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['id'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}
		if ($deleteRows) {
			$conn->commitTrans(); // Commit the changes
		} else {
			$conn->rollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("bdvlist.php"), "", $this->TableVar, TRUE);
		$pageId = "delete";
		$Breadcrumb->add("delete", $pageId, $url);
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
} // End class
?>