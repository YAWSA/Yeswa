<?php
namespace imanilchaudhari\CurrencyConverter\Cache\Adapter;

class FileSystem extends AbstractAdapter
{

    /**
     *
     * @var string
     */
    protected $cachePath = './';

    /**
     * Constructor
     *
     * @param string $cachePath
     */
    public function __construct($cachePath = null)
    {
        if ($cachePath !== null) {
            $this->setCachePath($cachePath);
        }
    }

    /**
     * Sets cachePath
     *
     * @param string $cachePath
     * @throws Exception\CachePathNotFoundException
     * @return self
     */
    public function setCachePath($cachePath)
    {
        if (! is_dir($cachePath)) {
            throw new Exception\CachePathNotFoundException(sprintf('Cache Path, %s does not exists', $cachePath));
        }
        $this->cachePath = $cachePath;
        
        return $this;
    }

    /**
     * Gets cachePath
     *
     * @return string
     */
    public function getCachePath()
    {
        return $this->cachePath;
    }

    /**
     *
     * {@inheritdoc}
     */
    protected function getCacheCreationTime($fromCurrency, $toCurrency)
    {
        return filemtime($this->getCacheFileLocation($fromCurrency, $toCurrency));
    }

    /**
     *
     * {@inheritdoc}
     */
    public function cacheExists($fromCurrency, $toCurrency)
    {
        $cacheFile = $this->getCacheFileLocation($fromCurrency, $toCurrency);
        if (! is_readable($cacheFile)) {
            return false;
        }
        
        return ! $this->isCacheExpired($fromCurrency, $toCurrency);
    }

    /**
     * Gets file location for specific currency conversion
     *
     * @param string $fromCurrency
     * @param string $toCurrency
     * @return string
     */
    protected function getCacheFileLocation($fromCurrency, $toCurrency)
    {
        return $this->cachePath . '/' . $fromCurrency . '-' . $toCurrency . '.cache';
    }

    /**
     *
     * {@inheritdoc}
     */
    public function createCache($fromCurrency, $toCurrency, $rate)
    {
        $cacheFile = $this->getCacheFileLocation($fromCurrency, $toCurrency);
        if (! file_exists($cacheFile)) {
            touch($cacheFile);
        }
        file_put_contents($cacheFile, $rate);
    }

    /**
     *
     * {@inheritdoc}
     */
    public function getRate($fromCurrency, $toCurrency)
    {
        return file_get_contents($this->getCacheFileLocation($fromCurrency, $toCurrency));
    }
}
