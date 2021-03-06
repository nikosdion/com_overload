<?php
/**
 * @package   overload
 * @copyright (c) 2011-2020 Nicholas K. Dionysopoulos
 * @license   GNU General Public License version 3 or later
 */

namespace Overload\Cli\Traits;

/**
 * Memory statistics
 *
 * This is an optional trait which allows the developer to print memory usage statistics and format byte sizes into
 * human-readable strings.
 *
 * @package Overload\Cli\Traits
 * @since   2.0.0
 */
trait MemStatsAware
{
	/**
	 * Formats a number of bytes in human readable format
	 *
	 * @param   int  $size  The size in bytes to format, e.g. 8254862
	 *
	 * @return  string  The human-readable representation of the byte size, e.g. "7.87 Mb"
	 * @since   2.0.0
	 */
	protected function formatByteSize($size)
	{
		$unit = ['b', 'KB', 'MB', 'GB', 'TB', 'PB'];

		return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
	}

	/**
	 * Returns the current memory usage, formatted
	 *
	 * @return  string
	 * @since   2.0.0
	 */
	protected function memUsage()
	{
		if (function_exists('memory_get_usage'))
		{
			$size = memory_get_usage();

			return $this->formatByteSize($size);
		}
		else
		{
			return "(unknown)";
		}
	}

	/**
	 * Returns the peak memory usage, formatted
	 *
	 * @return  string
	 * @since   2.0.0
	 */
	protected function peakMemUsage()
	{
		if (function_exists('memory_get_peak_usage'))
		{
			$size = memory_get_peak_usage();

			return $this->formatByteSize($size);
		}
		else
		{
			return "(unknown)";
		}
	}
}