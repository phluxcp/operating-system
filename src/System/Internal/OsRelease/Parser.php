<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\System\Internal\OsRelease;

use Phlux\Component\OperatingSystem\Exception\RuntimeException;
use Phlux\Component\OperatingSystem\Filesystem\FilesystemInterface;

final class Parser
{
    public const OS_RELEASE_FILE = '/etc/os-release';
    public const OS_RELEASE_FILE_FALLBACK = '/usr/lib/os-release';

    public function __construct(
        private FilesystemInterface $filesystem,
    ) {}

    /**
     * @throws Exception\OsReleaseFileNotFoundException
     */
    public function parse(): Data
    {
        $osReleaseFile = $this->getOsReleaseFile();

        /** @var array<string, scalar>|false $content */
        $content = \parse_ini_string($this->filesystem->read($osReleaseFile));

        if ($content === false) {
            throw new Exception\OsReleaseFileNotFoundException(sprintf(
                'The OS release file "%s" exists but could not be parsed.',
                $osReleaseFile,
            ));
        }

        return new Data(
            $this->buildIdentity($content),
            $this->buildVersion($content),
            $this->buildPresentation($content),
            $this->buildDistributionDefaults($content),
            new Data\Extra(),
        );
    }

    /**
     * @throws Exception\OsReleaseFileNotFoundException
     */
    public function getOsReleaseFile(): string
    {
        if ($this->filesystem->exists(self::OS_RELEASE_FILE)) {
            return self::OS_RELEASE_FILE;
        }

        if ($this->filesystem->exists(self::OS_RELEASE_FILE_FALLBACK)) {
            return self::OS_RELEASE_FILE_FALLBACK;
        }

        throw new Exception\OsReleaseFileNotFoundException(sprintf(
            'The OS release file "%s" does not exist.',
            self::OS_RELEASE_FILE,
        ));
    }

    /**
     * @param array<string, scalar>  $content
     * @param non-empty-string $key
     *
     * @return non-empty-string|null
     */
    private function getValue(array $content, string $key): null|string
    {
        if (!array_key_exists($key, $content) || !is_string($content[$key])) {
            return null;
        }

        $name = \trim($content[$key]);

        if ($name === '') {
            return null;
        }

        return $name;
    }

    /**
     * @param array<string, string> $content
     */
    private function buildIdentity(array $content): Data\Identity
    {
        return new Data\Identity(
            name: $this->getValue($content, Keys::NAME->value) ?? 'Linux',
            id: $this->getValue($content, Keys::ID->value) ?? 'linux',
            idLike: array_values(\array_filter(
                \explode(' ', $this->getValue($content, Keys::ID_LIKE->value) ?? ''),
                static fn(string $id) => \trim($id) !== '',
            )),
            prettyName: $this->getValue($content, Keys::PRETTY_NAME->value) ?? 'Linux',
            cpeName: $this->getValue($content, Keys::CPE_NAME->value),
            variant: $this->getValue($content, Keys::VARIANT->value),
            variantId: $this->getValue($content, Keys::VARIANT_ID->value),
        );
    }

    /**
     * @param array<string, string> $content
     */
    public function buildVersion(array $content): Data\Version
    {
        $releaseType = $this->getValue($content, Keys::RELEASE_TYPE->value);

        if ($releaseType !== null && !\in_array($releaseType, Data\Version::RELEASE_TYPES, true)) {
            throw new RuntimeException(sprintf(
                'The release type "%s" is not valid. Valid types are: "%s".',
                $releaseType,
                implode('", "', Data\Version::RELEASE_TYPES),
            ));
        }

        return new Data\Version(
            version: $this->getValue($content, Keys::VERSION->value),
            versionId: $this->getValue($content, Keys::VERSION_ID->value),
            versionCodename: $this->getValue($content, Keys::VERSION_CODENAME->value),
            buildId: $this->getValue($content, Keys::BUILD_ID->value),
            imageId: $this->getValue($content, Keys::IMAGE_ID->value),
            imageVersion: $this->getValue($content, Keys::IMAGE_VERSION->value),
            releaseType: $releaseType,
        );
    }

    /**
     * @param array<string, string> $content
     */
    public function buildPresentation(array $content): Data\Presentation
    {
        return new Data\Presentation(
            homeUrl: $this->getValue($content, Keys::HOME_URL->value),
            documentationUrl: $this->getValue($content, Keys::DOCUMENTATION_URL->value),
            supportUrl: $this->getValue($content, Keys::SUPPORT_URL->value),
            bugReportUrl: $this->getValue($content, Keys::BUG_REPORT_URL->value),
            privacyPolicyUrl: $this->getValue($content, Keys::PRIVACY_POLICY_URL->value),
            supportEnd: $this->getValue($content, Keys::SUPPORT_END->value),
            logo: $this->getValue($content, Keys::LOGO->value),
            ansiColor: $this->getValue($content, Keys::ANSI_COLOR->value),
            vendorName: $this->getValue($content, Keys::VENDOR_NAME->value),
            vendorUrl: $this->getValue($content, Keys::VENDOR_URL->value),
            experiment: $this->getValue($content, Keys::EXPERIMENT->value),
            experimentUrl: $this->getValue($content, Keys::EXPERIMENT_URL->value),
        );
    }

    /**
     * @param array<string, string> $content
     */
    public function buildDistributionDefaults(array $content): Data\DistributionDefaults
    {
        return new Data\DistributionDefaults(
            defaultHostname: $this->getValue($content, Keys::DEFAULT_HOSTNAME->value ?? ''),
            architecture: $this->getValue($content, Keys::ARCHITECTURE->value ?? ''),
            sysextLevel: $this->getValue($content, Keys::SYSEXT_LEVEL->value ?? ''),
            confextLevel: $this->getValue($content, Keys::CONFEXT_LEVEL->value ?? ''),
            sysextScope: isset($content[Keys::SYSEXT_SCOPE->value]) ? array_values(array_filter(explode(' ', $this->getValue($content, Keys::SYSEXT_SCOPE->value) ?? ''))) : [],
            confextScope: isset($content[Keys::CONFEXT_SCOPE->value]) ? array_values(array_filter(explode(' ', $this->getValue($content, Keys::CONFEXT_SCOPE->value) ?? ''))) : [],
            portablePrefixes: isset($content[Keys::PORTABLE_PREFIXES->value]) ? array_values(array_filter(explode(' ', $this->getValue($content, Keys::PORTABLE_PREFIXES->value) ?? ''))) : [],
        );
    }
}
