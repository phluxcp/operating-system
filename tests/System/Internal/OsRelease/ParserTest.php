<?php

declare(strict_types=1);

namespace Phlux\Component\OperatingSystem\Tests\System\Internal\OsRelease;

use Amp\File;
use Phlux\Component\OperatingSystem\Filesystem;
use Phlux\Component\OperatingSystem\System\Internal\OsRelease;
use Phlux\Component\OperatingSystem\Tests\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesClass;

#[CoversClass(OsRelease\Parser::class)]
#[CoversClass(OsRelease\Data::class)]
#[CoversClass(OsRelease\Data\DistributionDefaults::class)]
#[CoversClass(OsRelease\Data\Extra::class)]
#[CoversClass(OsRelease\Data\Identity::class)]
#[CoversClass(OsRelease\Data\Presentation::class)]
#[CoversClass(OsRelease\Data\Version::class)]
#[UsesClass(Filesystem\InMemory::class)]
#[UsesClass(Filesystem\Logger::class)]
final class ParserTest extends TestCase
{
    /**
     * @return iterable<array{string}>
     */
    public static function provide_full_os_release(): iterable
    {
        yield 'main path' => [
            OsRelease\Parser::OS_RELEASE_FILE,
        ];
        yield 'fallback path' => [
            OsRelease\Parser::OS_RELEASE_FILE_FALLBACK,
        ];
    }

    /**
     * @throws OsRelease\Exception\OsReleaseFileNotFoundException
     */
    #[DataProvider('provide_full_os_release')]
    public function test_full_os_release(string $path): void
    {
        $filesystem = new Filesystem\InMemory([
            $path => File\read(__DIR__ . '/Fixtures/ParserTest-full.os-release'),
        ]);

        $filesystem = new Filesystem\Logger($filesystem, $this->getLogger());

        $osRelease = new OsRelease\Data(new OsRelease\Data\Identity(
            name: 'ExampleOS',
            id: 'exampleos',
            idLike: ['linux', 'example'],
            prettyName: 'Example Operating System',
            cpeName: 'cpe:/o:example:exampleos:1.0',
            variant: 'Example Desktop',
            variantId: 'example-desktop',
        ), new OsRelease\Data\Version(
            version: '2.5 (Aurora)',
            versionId: '2.5',
            versionCodename: 'aurora',
            buildId: '20250801',
            imageId: 'aurora-image',
            imageVersion: '2025.08.01',
            releaseType: 'development',
        ), new OsRelease\Data\Presentation(
            homeUrl: 'https://www.ficticiosystem.org/',
            documentationUrl: 'https://docs.ficticiosystem.org/',
            supportUrl: 'https://support.ficticiosystem.org/',
            bugReportUrl: 'https://bugs.ficticiosystem.org/',
            privacyPolicyUrl: 'https://privacy.ficticiosystem.org/',
            supportEnd: '2027-12-31',
            logo: 'ficticiosystem-logo',
            ansiColor: '0;36',
            vendorName: 'Ficticio Corp',
            vendorUrl: 'https://www.ficticiocorp.com/',
            experiment: 'beta-ui',
            experimentUrl: 'https://beta.ficticiosystem.org/',
        ), new OsRelease\Data\DistributionDefaults(
            defaultHostname: 'ficticiosystem',
            architecture: 'x86_64',
            sysextLevel: '2',
            confextLevel: '1',
            sysextScope: ['system', 'vendor'],
            confextScope: ['user'],
            portablePrefixes: ['/usr', '/opt', '/home'],
        ), new OsRelease\Data\Extra());

        $this->assertEquals($osRelease, new OsRelease\Parser($filesystem)->parse());
    }
}
