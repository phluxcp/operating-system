<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System\Internal\OsRelease;

enum Keys: string
{
    case NAME = 'NAME';
    case ID = 'ID';
    case ID_LIKE = 'ID_LIKE';
    case PRETTY_NAME = 'PRETTY_NAME';
    case CPE_NAME = 'CPE_NAME';
    case VARIANT = 'VARIANT';
    case VARIANT_ID = 'VARIANT_ID';
    case VERSION = 'VERSION';
    case VERSION_ID = 'VERSION_ID';
    case VERSION_CODENAME = 'VERSION_CODENAME';
    case BUILD_ID = 'BUILD_ID';
    case IMAGE_ID = 'IMAGE_ID';
    case IMAGE_VERSION = 'IMAGE_VERSION';
    case RELEASE_TYPE = 'RELEASE_TYPE';
    case HOME_URL = 'HOME_URL';
    case DOCUMENTATION_URL = 'DOCUMENTATION_URL';
    case SUPPORT_URL = 'SUPPORT_URL';
    case BUG_REPORT_URL = 'BUG_REPORT_URL';
    case PRIVACY_POLICY_URL = 'PRIVACY_POLICY_URL';
    case SUPPORT_END = 'SUPPORT_END';
    case LOGO = 'LOGO';
    case ANSI_COLOR = 'ANSI_COLOR';
    case VENDOR_NAME = 'VENDOR_NAME';
    case VENDOR_URL = 'VENDOR_URL';
    case EXPERIMENT = 'EXPERIMENT';
    case EXPERIMENT_URL = 'EXPERIMENT_URL';
    case DEFAULT_HOSTNAME = 'DEFAULT_HOSTNAME';
    case ARCHITECTURE = 'ARCHITECTURE';
    case SYSEXT_LEVEL = 'SYSEXT_LEVEL';
    case CONFEXT_LEVEL = 'CONFEXT_LEVEL';
    case SYSEXT_SCOPE = 'SYSEXT_SCOPE';
    case CONFEXT_SCOPE = 'CONFEXT_SCOPE';
    case PORTABLE_PREFIXES = 'PORTABLE_PREFIXES';
}
